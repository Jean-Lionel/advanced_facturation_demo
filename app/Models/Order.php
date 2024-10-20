<?php

namespace App\Models;

use App\Models\PaiementDette;
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
            // add a new column invoice_currency on order if it doesn't already exist
            // Check if the 'invoice_currency' column exists in the 'orders' table
            if (!Schema::hasColumn('orders', 'invoice_currency')) {
                // Add the 'invoice_currency' column if it doesn't exist
                Schema::table('orders', function ($table) {
                    $table->string('invoice_currency', 10)->nullable();
                });
            }

            Session::put('cancel_syncronize', false);
		});

        self::updating(function($model){
            $model->user_id = Auth::user()->id ?? 1;
            Session::put('cancel_syncronize', false);
        });

        self::created(function($model){
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
        });
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
}
