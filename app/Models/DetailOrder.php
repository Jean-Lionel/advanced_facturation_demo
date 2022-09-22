<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DetailOrder extends Model
{
    use HasFactory;

    protected $fillable = [
    	'product_id','quantite','quantite_stock','price_unitaire','code_product','name','unite_mesure','date_expiration','order_id','user_id', 'embalage'];

    public static function boot(){
    	parent::boot();

    	self::creating(function($model){
    		$model->user_id = Auth::user()->id ?? 0;
    	});
    }

    public function product(){
    	return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
