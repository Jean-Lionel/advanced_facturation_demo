<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retenue extends Model
{
    use HasFactory;

    protected $table = 'hrm_employee_retenue';

    protected $primaryKey = "employee_retenue_id";

    protected $fillable = [
        "retenue_id", "employee_id_in_retenue", "retenue_amount",
        "retenue_month", "created_by"
    ];

    /**
     * Get the user that created the record.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user that created the record.
     */
    public function type()
    {
        return $this->belongsTo(TypeRetenue::class, 'retenue_id');
    }

    /**
     * Get the employee that related to the record.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id_in_retenue');
    }
}
