<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeRetenue extends Model
{
    use HasFactory;

    protected $table = 'hrm_retenue_type';

    protected $primaryKey = 'id_retenue_type';


    protected $fillable = [
        "name_retenue_type", "createdBy_retenue_type"
    ];

    /**
     * Get the user that created the record.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'createdBy_retenue_type');
    }
}
