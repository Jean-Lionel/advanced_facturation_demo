<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SyncronizeController extends Controller
{
    //

    public function syncronize(){
        return response()->json([
            'success' => true,
            'data' => 1,

        ]);
    }
}
