<?php

namespace App\Models;

use App\Models\Traits\SearchOnModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $compte_id
 * @property int $client_id
 * @property string $mode_payement
 * @property string $title
 * @property double $montant
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class BienvenuHistorique extends Model
{
    use HasFactory, SearchOnModel;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'compte_id' => 'integer',
        'client_id' => 'integer',
        'montant' => 'double',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function compte()
    {
        return $this->belongsTo(Compte::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function user(){
        return $this->belongsTo(\App\Models\User::class);
    }
}
