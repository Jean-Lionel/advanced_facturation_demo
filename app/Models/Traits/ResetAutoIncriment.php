<?php
namespace App\Models\Traits;
use Illuminate\Support\Facades\DB;


trait ResetAutoIncriment{
   
    public function boot(){
        static::created(function ($model) {
            DB::statement("SET GLOBAL innodb_autoinc_lock_mode = 0;");
        });
    }
    
}