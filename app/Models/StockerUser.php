<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockerUser extends Model
{
    use HasFactory;
    protected $fillable = ['stock_id', 'user_id'];

    public function stock(){
        return $this->belongsTo(Stocke::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
