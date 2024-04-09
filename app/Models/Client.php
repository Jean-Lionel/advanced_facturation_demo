<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends MyModel
{
	use HasFactory;

	protected $guarded = [];

    public static $FOURNISSEUR = 'on';

    public function compte(){
        return $this->hasOne(Compte::class);
    }
}
