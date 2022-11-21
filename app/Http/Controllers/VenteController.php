<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\SendInvoiceToOBR;

class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
quantite
category_id

     *
     * @return \Illuminate\Http\Response
     */
public function index()
{

   new SendInvoiceToOBR();

  $search = \Request::get('search'); 
  $products = Product::where('quantite','>',1)
  ->where(function($query) use ($search){
    $query->where('name','like','%'.$search.'%')
    ->orWhere('code_product','like', '%'.$search.'%')
    ->orWhere('price','like', '%'.$search.'%')
    ->orWhere('unite_mesure','like', '%'.$search.'%');
})->latest()->paginate(6);
  return view('ventes.index', compact('products','search'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vente  $vente
     * @return \Illuminate\Http\Response
     */
    public function show(Vente $vente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vente  $vente
     * @return \Illuminate\Http\Response
     */
    public function edit(Vente $vente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vente  $vente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vente $vente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vente  $vente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vente $vente)
    {
        //
    }
}
