<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductHistory extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sortable;

    protected $guarded = [];

    public static function boot(){
        parent::boot();

        self::creating(function($model){
            $model->user_id = auth()->user()->id;
            $model->product_id = $model->id;
            $model->id = null;
        });
    }
}
