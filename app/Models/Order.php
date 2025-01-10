<?php

namespace App\Models;

use App\Models\PaiementDette;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Kyslik\ColumnSortable\Sortable;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sortable;

protected $guarded = [];
 public $sortable = ['amount',
'products','user_id','tax','amount_tax','client','type_paiement', 'date_facturation', 'invoice_signature'];

	public static function boot(){
		parent::boot();

		self::creating(function($model){
			$model->user_id = Auth::user()->id ?? 1;
			$model->client_id = $model->client->id ?? 0;
			$model->invoice_type = $model->invoice_type ??  'FN';
            try {
                //code...
                self::checkCanCreateNewRecord();
                self::updateDatabases();
            } catch (\Throwable $th) {
                throw new \Exception($th->getMessage());
            }

            Session::put('cancel_syncronize', false);
		});

        self::updating(function($model){
            $model->user_id = Auth::user()->id ?? 1;
            Session::put('cancel_syncronize', false);
        });

        self::created(function($model){
            \DB::Transaction(function() use ($model){
                if(env('APP_USE_ABONEMENT',false)){

            $montant = collect($model->products)->pluck('interet_total')->sum();
            OrderInteret::create([
                'order_id' => $model->id,
                'user_id' => $model->user_id,
                'montant' => $montant ,
                'description' => json_encode([
                    'type' => 'VENTE',
                    'commissionaire_id' => $model->commissionaire_id,
                    'client_id' => $model->client_id,
                    'partage' => [
                        'Informaticien' => ($montant * PARTAGE_INFORMATICIEN / 100),
                        'Client' => ($montant * PARTAGE_CLIENT / 100),
                        'Commisionnaire' => ($montant * PARTAGE_COMMISSIONNAIRE  / 100),
                        'Entreprise' => ($montant * PARTAGE_ENTREPRISE  / 100),
                    ]

                ]),
            ]);
            // Mettre a jour le compte du commistionnaire et du clients
            if($model->commissionaire_id){
                $commissionaire = Client::find($model->commissionaire_id);
                $comm_interet = $montant * PARTAGE_COMMISSIONNAIRE  / 100;

                $montantActuel = $commissionaire->compte?->montant ?? 0;
                $MontTotal = $montantActuel + $comm_interet;
                $commissionaire->compte->update(['montant' => $MontTotal]);
                // Historique du compte
                BienvenuHistorique::create([
                    'compte_id'=>$commissionaire->compte->id,
                    'client_id'=>$model->commissionaire_id,
                    'mode_payement'=>"Compte",
                    'title'=>'Intéret',
                    'montant'=>$comm_interet,
                    'description'=>"Montant d'interet partage de {$comm_interet}",
                ]);
            }
            if($model->client_id){
                $client = Client::find($model->client_id);
                $client_interet = $montant * PARTAGE_CLIENT / 100;

                $montantActuel = $client->compte->montant;
                $MontTotal = $montantActuel + $client_interet;
                $client->compte->update(['montant' => $MontTotal]);
                // Historique du compte
                BienvenuHistorique::create([
                    'compte_id'=>$client->compte->id,
                    'client_id'=>$model->client_id,
                    'mode_payement'=>"Compte",
                    'title'=>'Intéret',
                    'montant'=>$client_interet,
                    'description'=>"Montant d'interet partage de {$client_interet}",
                ]);
            }
                }
            });


        });
	}


    public function client(){
            return $this->belongsTo(Client::class);
    }


	public function details(){
		return $this->hasMany('App\Models\DetailOrder','order_id');
	}


	public function dette(){
		return $this->belongsTo(PaiementDette::class , 'id','order_id');
	}

	public function getClientAttribute($v)
	{
		return json_decode($v);
	}

    public function concelInvoice(){
        return $this->belongsTo(CanceledInvoince::class, 'id','order_id');
    }

    public function obrPointer(){
        return $this->belongsTo(ObrPointer::class, 'id','order_id');
    }
	//products
	public function getProductsAttribute($v)
	{
		return unserialize($v);
	}
    public function getInteretAttribute(){
        return collect($this->products)->pluck('interet_total')->sum();
    }
    public function getCompanyAttribute($v){
        return json_decode($v) ?  json_decode($v) : Entreprise::currentEntreprise();
    }

    public function commissionaire(){
        return $this->belongsTo(Client::class , 'commissionaire_id');
    }

    private static function updateDatabases(){
         // add a new column invoice_currency on order if it doesn't already exist
            // Check if the 'invoice_currency' column exists in the 'orders' table
            if (!Schema::hasColumn('orders', 'invoice_currency')) {
                // Add the 'invoice_currency' column if it doesn't exist
                Schema::table('orders', function ($table) {
                    $table->string('invoice_currency', 10)->nullable();
                });
            }
           // "invoice_type" => "FN",
            if (!Schema::hasColumn('orders', 'invoice_type')) {
                // Add the 'invoice_currency' column if it doesn't exist
                Schema::table('orders', function ($table) {
                    $table->string('invoice_type', 10)->nullable();
                });
            }

    }


    private static function checkCanCreateNewRecord(){
        $lastRecord = self::where('user_id', auth()->id())
        ->latest()
        ->first();
        if ($lastRecord) {
            // Calculer le temps écoulé depuis le dernier enregistrement
            $timeElapsed = Carbon::parse($lastRecord->created_at)->diffInSeconds(Carbon::now());
            // Si moins d'une minute s'est écoulée
            if ($timeElapsed < TEMPS_GENERATION_FACTURE) {
                $remainingTime = TEMPS_GENERATION_FACTURE - $timeElapsed;
                throw new \Exception("Veuillez attendre encore {$remainingTime} secondes avant de créer un nouvel enregistrement.");
            }
        }
        return true;
    }
}
