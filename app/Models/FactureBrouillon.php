<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactureBrouillon extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'lignes' => 'array',
        'assurance' => 'array',
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
