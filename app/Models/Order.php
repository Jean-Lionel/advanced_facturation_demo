<?php

namespace App\Models;

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

    public function getCompanyAttribute($v){

        return json_decode($v) ?  json_decode($v) : Entreprise::currentEntreprise();
    }
}
