<?php

namespace App\Http\Controllers;

use App\Models\OrderInteret;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    //

    public function rapport_detail(){

        return view('reports.index');
    }

    public function partage_interet(){
        $interets = OrderInteret::latest()->paginate();
        return view('reports.partage', compact('interets'));
    }
}
