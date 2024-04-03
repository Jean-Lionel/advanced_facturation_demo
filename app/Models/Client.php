<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends MyModel
{
	use HasFactory;

	protected $guarded = [];

    public function compte(){
        return $this->hasOne(Compte::class);
    }
}
