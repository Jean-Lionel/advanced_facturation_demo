<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'hrm_employee';

    protected $primaryKey = 'employee_id';

    public $timestamps = false;

    protected $fillable = [
        "first_name", "last_name", "date_of_birth", "gender", "cni_number", "full_address", "school_degree",
        "phone", "email", "joining_date", "father_name", "mother_name", "leaving_date", "code_inss", "fonction_id", "work_address", "status",
        "created_date", "created_by", "modified_date", "modified_by", "maratial_status"
    ];


    /**
     * Get the user that created the record.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function poste()
    {
        return $this->belongsTo(Poste::class, 'fonction_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'school_degree');
    }

    public function salary()
    {
        return $this->hasOne(Payroll::class, 'employee_id');
    }

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }
}
