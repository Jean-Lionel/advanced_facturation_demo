<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Service extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded= [];

    public static function boot(){
    	parent::boot();

    	self::creating(function($model){
    		$model->user_id = Auth::user()->id;
    	});
    }
}
