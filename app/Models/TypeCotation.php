<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeCotation extends Model
{
    use HasFactory;

    protected $table = 'hrm_type_cotation';

    protected $primaryKey = 'type_cotation_id';

    public $timestamps = false;

    protected $fillable = [
       "title","percentage","created_by","created_date" 
    ];

    /**
     * Get the user that created the record.
     */
    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
