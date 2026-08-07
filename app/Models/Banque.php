<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $user_id
 * @property int $entreprise_id
 * @property string $name
<<<<<<< HEAD
 * @property string $account_number
 * @property string $swift_code
 * @property string $iban
 * @property string $description
 * @property bool $is_default
=======
 * @property string $account_name
 * @property string $account_number
 * @property string $account_type
 * @property string $currency
 * @property string $description
 * @property bool $is_active
>>>>>>> 043cea9fb5525bcc48c850b9483b22cdda8600f1
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Banque extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
<<<<<<< HEAD
        'entreprise_id' => 'integer',
        'is_default' => 'boolean',
    ];

=======
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getDisplayNameAttribute()
    {
        return trim($this->name . ' - ' . $this->account_number . ' (' . $this->currency . ')');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
>>>>>>> 043cea9fb5525bcc48c850b9483b22cdda8600f1
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
}
