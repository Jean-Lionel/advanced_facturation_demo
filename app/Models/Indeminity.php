<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indeminity extends Model
{
    use HasFactory;

    protected $table = 'hrm_type_indeminite';

    protected $primaryKey = 'type_indeminite_id';

    protected $fillable = [
        "title", "percentage", "taxable", "created_by"
    ];

    /**
     * Get the user that created the record.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
