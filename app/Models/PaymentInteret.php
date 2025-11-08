<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentInteret extends Model
{
    use HasFactory;

    protected $table = 'payment_interets';

    protected $fillable = [
        'client_id',
        'title',
        'montant',
        'remarque',
        'type_beneficiaire',
        'date_paiement',
        'statut'
    ];

    protected $casts = [
        'montant' => 'decimal:2',
        'date_paiement' => 'datetime'
    ];

    /**
     * Relation avec Client
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Relation avec OrderInteret
     */
    public function orderInterets()
    {
        return $this->hasMany(OrderInteret::class, 'payment_id');
    }
}
