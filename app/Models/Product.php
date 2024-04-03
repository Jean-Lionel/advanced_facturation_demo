<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Kyslik\ColumnSortable\Sortable;

class Product extends MyModel
{
    use HasFactory;
    use SoftDeletes;
    use Sortable;

//     code_product
// name
// unite_mesure
// quantite
// quantite_alert
// price
// price_max
// price_min
// date_expiration
// description
// category_id
    protected $fillable = ['code_product','name','price','date_expiration','quantite','quantite_alert','category_id','unite_mesure','price_min','price_max','description','marque', 'taux_tva'];

    protected $sortable= ['code_product','name','price','date_expiration','quantite','quantite_alert','category_id','unite_mesure','price_min','price_max','description','marque', 'taux_tva'];

    protected $appends = ['priceHorsTva'];
    public static function boot(){
        parent::boot();
        self::creating(function($model){
            $model->user_id = auth()->user()->id ?? 1;
        });
        self::updating(function($model){
            $model->user_id = auth()->user()->id ?? 1;
        });
    }

    public function getPriXAchatAttribute(){
        return $this->price_min;
    }

    public function getPriXVenteAttribute(){
        return $this->price;
    }

    public function getPrixRevientAttribute(){
        return $this->price_max;
    }

    public function setPrixRevientAttribute($value){
        $this->attributes['price_max'] = $value;
    }

    public function lastMouvement(){
        $mouvement = ObrMouvementStock::where('item_code', '  >=>', $this->id)->latest()->first();
        return  $mouvement ;
    }
    public function item_movement_type(){
        $mouvement = ObrMouvementStock::where('item_code', '  >=>', $this->id)->latest()->first();
        return  $mouvement ? $mouvement->item_movement_type : "-";
    }

    public function mouvements(){
        return $this->hasMany(ObrMouvementStock::class, 'item_code');
    }

    public function category()
    {
       // return Cache::remember('category_product_'. $this->id, 60*24, function () {
            return $this->belongsTo(Category::class, 'category_id');
        //});
    }

    public function getPriceHorsTvaAttribute(){
        return  prixVenteHorsTva($this->price , $this->taux_tva);
    }

}
