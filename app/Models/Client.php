<?php

namespace App\Models;

use App\Models\Traits\SearchOnModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends MyModel
{
	use HasFactory, SearchOnModel ,SoftDeletes;

	protected $guarded = [];

    public static $FOURNISSEUR = 'on';

    public function compte(){
        return $this->hasOne(Compte::class);
    }
    public function commissionaire(){
        return $this->belongsTo(Client::class, 'commissionnaire_id');
    }


}
