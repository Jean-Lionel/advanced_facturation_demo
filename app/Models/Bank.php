<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $table = 'hrm_bank';

    protected $primaryKey = 'bank_id';

    protected $fillable = [
        "bank_name", "bank_code", "created_by"
    ];

    /**
     * Get the user that created the record.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
