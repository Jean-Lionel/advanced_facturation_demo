<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportationController extends Controller
{
    //

    public function index(){

        return view('importations.index');
    }

    public function store(Request $request){
        $request->validate([
            'file' => 'required',
        ]);
       // Excel::import(new UsersImport, $request->file);
       $result = Excel::toArray(new UsersImport, $request->file);

        dd($result);
    }
}
