<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $table = 'hrm_employee_payroll';

    protected $primaryKey = 'payroll_id';

    public $timestamps = false;

    protected $fillable = [
        "employee_id","basic_salary","net_salary","work_days_per_month","brut_salary","payment_type",
        "transport_allowance","additional_pension","created_date","created_by"
    ];

    /**
     * Get the user that created the record.
     */
    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
