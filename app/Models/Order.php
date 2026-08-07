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
        self::updateOrderTable();
        
        // Add a new column invoice_number on orders if it doesn't already exist
        
        self::creating(function($model){
            $model->client_id = $model->client->id ?? 0;
            $model->invoice_type = $model->invoice_type ??  'FN';
            // Checking the last inserted id of the invoice
            // Select max id from orders table
            $lastInsertedId = self::select('id')->orderBy('id', 'desc')->first();
            if ($lastInsertedId) {
                $model->id = $lastInsertedId->id + 1;
            } else {
                $model->invoice_number = 1;
            }
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
            $model->user_id = Auth::user()->id ?? 1;
            try {
                self::updateDatabases();
            } catch (\Throwable $th) {
                throw new \Exception($th->getMessage());
            }
            
            Session::put('cancel_syncronize', false);
        });
        self::created(function($model){
            // dd($model->products);
            if(env('APP_CAN_CALCULE_INTERET', false)){
                $montant = collect($model->products)->pluck('interet_total')->sum();
                $commission = ($montant * PARTAGE_COMMISSIONNAIRE  / 100);
                $achatCmmission = ($montant * PARTAGE_CLIENT / 100);
                $cre =   OrderInteret::create([
                    'order_id' => $model->id,
                    'user_id' => $model->user_id,
                    'montant' => $montant ,
                    'description' => json_encode([
                        'type' => 'VENTE',
                        'commissionaire_id' => $model->commissionaire_id,
                        'client_id' => $model->client_id,
                        'partage' => [
                            'Informaticien' => ($montant * PARTAGE_INFORMATICIEN / 100),
                            'Client' => $achatCmmission ,//($montant * PARTAGE_CLIENT / 100),
                            'Commisionnaire' =>  $commission,
                            'Entreprise' => ($montant * PARTAGE_ENTREPRISE  / 100),
                            ]
                        ]),
                    ]);
                    // dd($cre, env('APP_CAN_CALCULE_INTERET', false) , $model);
                    // Writte historique Montant sur le compte du commissionnaire
                    
                    $compteCommissionnaire = Compte::where('client_id', $model->commissionaire_id)->first();
                    $compteClient = Compte::where('client_id', $model->client_id)->first();
                    // Commissionnair
                    if($compteCommissionnaire &&  $compteClient ){
                        $compteCommissionnaire->montant += $commission;
                        $compteClient->montant += $achatCmmission;
                        $compteCommissionnaire->save();
                        $compteClient->save();
                        BienvenuHistorique::create([
                            'compte_id' =>   $compteCommissionnaire->id,
                            'client_id' =>  $model->commissionaire_id,
                            'mode_payement' => 1,
                            'title' => 'COMMISSION',
                            'montant' => $commission,
                            'description' => "REF #". $cre->id . " Commission sur vente du facture Client No" . $model->client_id,
                            'user_id' => auth()->user()->id
                        ]);
                        // Client
                        BienvenuHistorique::create([
                            'compte_id' =>   $compteClient->id,
                            'client_id' =>  $model->client_id,
                            'mode_payement' => 1,
                            'title' => 'RESTOURNE SUR  ACHAT',
                            'montant' => $achatCmmission,
                            'description' => "REF #". $cre->id .  " Commission sur Achat du facture Client No" . $model->client_id,
                            'user_id' => auth()->user()->id
                        ]);
                        
                    }
                    // Augmenter le montant du compte
                }
                
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

        public function getBanqueAttribute($v)
        {
            return json_decode($v);
        }

        public function banqueRecord()
        {
            return $this->belongsTo(Banque::class, 'banque_id');
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
            if (!Schema::hasColumn('orders', 'banque_id')) {
                Schema::table('orders', function ($table) {
                    $table->unsignedBigInteger('banque_id')->nullable();
                });
            }
            if (!Schema::hasColumn('orders', 'banque')) {
                Schema::table('orders', function ($table) {
                    $table->text('banque')->nullable();
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
        
        public function entreprise(){
            return Entreprise::currentEntreprise();
        }
        
        public function user(){
            return $this->belongsTo(User::class,'user_id');
        }
        
        public static function updateOrderTable(){
            // Add column cn_motif if not exists 
            $currents = [
                'cn_motif','invoice_ref','cn_motif','par_client', 'par_assurance', 'par_client_pourcentage', 'par_assurance_pourcentage',
                'assurance_id', 'assurance_name', 'supplement'
            ];

            foreach ($currents as $current) {
                if (!Schema::hasColumn('orders', $current)) {
                    Schema::table('orders', function ($table) use ($current) {
                        $table->text($current)->nullable();
                    });
                }
            }
            
        }
    }
