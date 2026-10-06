<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Depense extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'montant', 'user_id', 'description', 'depense_category_id', 'date_depense'];

    protected $casts = [
        'date_depense' => 'date',
    ];

    public static function boot(){
    	parent::boot();

    	self::creating(function($model){
    		$model->user_id = Auth::user()->id;

    	});
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(DepenseCategory::class, 'depense_category_id');
    }

    public function scopeFilteredReport($query, $startDate, $endDate, $search = null)
    {
        return $query->with(['user', 'category'])
            ->whereBetween('date_depense', [$startDate, $endDate])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($inner) use ($search) {
                    $inner->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('date_depense', 'desc');
    }
}
