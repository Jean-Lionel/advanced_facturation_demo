<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $table = "hrm_paid_leave";

    protected $primaryKey = "paid_leave_id";

    public $timestamps = false;

    protected $fillable = [
        "employee_id","leave_category_id","employee_remplacant","start_date","end_date",
        "period","leave_status","request_date","confirmation_or_reject_date",
        "created_by","confirmed_by","rejected_by"
    ];

    /**
     * Get the user that created the record.
     */
    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    /**
     * Get the user that created the record.
     */
    public function confirm()
    {
        return $this->belongsTo(User::class,'confirmed_by');
    }

    /**
     * Get the user that created the record.
     */
    public function reject()
    {
        return $this->belongsTo(User::class,'rejected_by');
    }

    /**
     * Get the user that created the record.
     */
    public function type()
    {
        return $this->belongsTo(TypeLeave::class,'leave_category_id');
    }

    /**
     * Get the employee that related to the record.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
