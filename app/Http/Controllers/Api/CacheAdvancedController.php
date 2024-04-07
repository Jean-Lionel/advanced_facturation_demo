<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class CacheAdvancedController extends Controller
{
    //

    public function index(){
        cache()->flush();

        return back();
    }
}
