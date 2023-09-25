<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ObrStockController extends Controller
{
    public function retour_produit(){
        return view('journals.return_product');
    }
}
