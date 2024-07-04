<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeLeave extends Model
{
    use HasFactory;

    protected $table = 'hrm_leave_category';

    protected $primaryKey = 'leave_category_id';

    protected $fillable = [
        "category", "created_by"
    ];

    /**
     * Get the user that created the record.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
