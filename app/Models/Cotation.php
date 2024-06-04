<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotation extends Model
{
    use HasFactory;

    protected $table = "hrm_cotation";

    protected $primaryKey = "cotation_id";

    public $timestamps = false;

    protected $fillable = [
        "employee_id","type_cotation","cotation_status","note_cotation","created_date","confirmation_or_reject_date",
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
        return $this->belongsTo(TypeCotation::class,'type_cotation');
    }

    /**
     * Get the employee that related to the record.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
