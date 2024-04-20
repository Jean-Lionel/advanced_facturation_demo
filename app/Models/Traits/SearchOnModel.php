<?php

namespace App\Models\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;


trait SearchOnModel{
    use SoftDeletes;
    /**
    * Summary of getPaginateData
    * @return mixed
    * This method Help to search on Model based on all parameters
    */
    function getPaginateData(){
        $search = request()->query("search");
        $columns = Schema::getColumnListing($this->getTable());
        $query = self::query();
        $query->where(function ($q) use ($columns, $search) {
            foreach ($columns as $column) {
                $q->orWhere($column, 'LIKE', '%' . $search . '%');
            }
        });
        $data = []; //Tableau vide
        // if(!auth()->user()->isAdmin()){
            //     $data = $query->where('user_id', auth()->user()->id )->latest()->paginate();
            // }else{
                //     $data = $query->latest()->paginate();
                // }

                $data = $query->latest()->paginate();

                return $data;
            }

            public static function boot()
            {
                parent::boot();
                self::creating(function ($model) {
                    $model->user_id = auth()->user()->id ?? 0;
                });
                self::updating(function ($model) {
                    $model->user_id = auth()->user()->id;
                });
                self::deleting(function ($model) {
                    $model->user_id = auth()->user()->id;
                });
                # code...
            }


            public function user()
            {
                return $this->belongsTo(User::class, 'user_id');
            }

        }
