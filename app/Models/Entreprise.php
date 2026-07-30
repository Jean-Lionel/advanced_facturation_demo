<?php

namespace App\Models;

use Doctrine\Common\Cache\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entreprise extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public static function currentEntreprise()
    {
        return Entreprise::where('is_actif', 1)->first() ?? Entreprise::latest()->first();
    }

    public function banques()
    {
        return $this->hasMany(Banque::class);
    }

    public function defaultBanque()
    {
        return $this->hasOne(Banque::class)->where('is_default', true);
    }
}
