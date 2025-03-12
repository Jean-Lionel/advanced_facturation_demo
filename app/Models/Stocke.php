<?php

namespace App\Models;

use App\Models\MyModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stocke extends MyModel
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function products(){
        return $this->belongsToMany(Product::class, 'product_stocks', 'stock_id', 'product_id');
    }

    public function stockProducts(){
        return $this->hasMany(ProductStock::class, 'stock_id');
    }
    public function users(){
        return $this->hasMany(StockerUser::class, 'user_id');
    }
}
