<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','stock_id'
];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function stock(){
        return $this->belongsTo(Stocke::class);
    }
}
