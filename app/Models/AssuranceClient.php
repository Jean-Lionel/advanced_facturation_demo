<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $client_id
 * @property int $assurance_id
 * @property \Carbon\Carbon $expire_date
 * @property float $par_client
 * @property float $par_assurance
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class AssuranceClient extends Model
{
    use HasFactory, SoftDeletes;

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
        'expire_date' => 'date',
        'par_client' => 'float',
        'par_assurance' => 'float',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function assurance()
    {
        return $this->belongsTo(Assurance::class);
    }
}
