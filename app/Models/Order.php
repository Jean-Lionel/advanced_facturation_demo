<?php

namespace App\Models;

use App\Enums\InteretEnumValue;
use App\Models\PaiementDette;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Kyslik\ColumnSortable\Sortable;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sortable;

//    protected $fillable = ['amount',
//'products','user_id','tax','amount_tax','client','type_paiement', 'total_quantity', 'total_sacs', 'addresse_client', 'date_facturation', 'is_cancelled', 'invoice_signature'];

protected $guarded = [];
 public $sortable = ['amount',
'products','user_id','tax','amount_tax','client','type_paiement', 'date_facturation', 'invoice_signature'];

	public static function boot(){
		parent::boot();
		self::creating(function($model){
			$model->user_id = Auth::user()->id ?? 1;

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
                        'Informaticien' => ($montant *15 / 100),
                        'Client' => ($montant * 5 / 100),
                        'Commisionnaire' => ($montant * 5  / 100),
                        'Entreprise' => ($montant * 75  / 100),
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
