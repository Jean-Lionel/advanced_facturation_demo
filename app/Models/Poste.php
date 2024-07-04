<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poste extends Model
{
    use HasFactory;

    protected $table = 'hrm_fonctions';

    protected $primaryKey = 'fonction_id';

    protected $fillable = [
        "title", "department_id", "created_by"
    ];

    /**
     * Get the user that created the record.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the department that Poste beloged too.
     */
    public function department()
    {
        return $this->belongsTo(Departement::class, 'department_id');
    }
}
