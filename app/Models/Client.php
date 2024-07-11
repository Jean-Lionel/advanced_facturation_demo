<?php

namespace App\Models;

use App\Models\Traits\SearchOnModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends MyModel
{
	use HasFactory, SearchOnModel;

	protected $guarded = [];

    public static $FOURNISSEUR = 'on';

    public function compte(){
        return $this->hasOne(Compte::class);
    }
    
}
