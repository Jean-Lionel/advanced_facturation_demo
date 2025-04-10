<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proformat extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

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
    public function getClientAttribute($v)
	{
		return json_decode($v);
	}
}
