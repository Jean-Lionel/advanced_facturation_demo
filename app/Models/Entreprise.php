<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entreprise extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public static function currentEntreprise()
    {

        return  Entreprise::where('is_actif', 1)->first() ?? new Entreprise(); ;
    }
}
