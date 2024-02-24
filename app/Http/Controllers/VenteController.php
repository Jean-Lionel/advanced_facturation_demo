<?php

namespace App\Http\Controllers;

use App\Jobs\SyncroniseInvoice;
use App\Models\Vente;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\SendInvoiceToOBR;
use PhpParser\Node\Stmt\TryCatch;

class VenteController extends Controller
{

    public function index()
    {

        // $r = sendHttpRequest();
        //dd($obr->getInvoice('4001996828/ws400199682800460/20230222083742/000030'));
        //dd($obr->checkTin('4002208256'));


        //pc connecté à internet
        dd(isInternetConnection());

        $search = \Request::get('search');
        $products = Product::where('quantite', '>', 1)
        ->where(function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('code_product', 'like', '%' . $search . '%')
            ->orWhere('price', 'like', '%' . $search . '%')
            ->orWhere('unite_mesure', 'like', '%' . $search . '%');
        })->latest()->paginate(6);
        SyncroniseInvoice::dispatch(1);
        return view('ventes.index', compact('products', 'search'));
    }


    public function create()
    {
        //
       return view('ventes.create');
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
