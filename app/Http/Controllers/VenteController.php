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

    public function index(Request $request)
    {
        // $obr = new SendInvoiceToOBR();

        // dd($obr->getToken());
        $search = \Request::get('search');
        $products = Product::where('quantite', '>', 1)
        ->where(function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('code_product', 'like', '%' . $search . '%')
            ->orWhere('price', 'like', '%' . $search . '%')
            ->orWhere('unite_mesure', 'like', '%' . $search . '%');
        })->latest()->take(6)->get();
        SyncroniseInvoice::dispatch(1);


        $value_products = $this->makeProductBody($products);

        if($request->ajax()){

            return $value_products ;
        }


        return view('ventes.index', compact('products', 'value_products', 'search'));
    }


    private function makeProductBody($products){

        $body = "";

        foreach ($products as $value){
            $body .= <<<EOD
            <tr>
            <td> $value->id </td>
            <td> $value->code_product </td>
            <td>
                 $value->name
            </td>
            <td> $value->price </td>
            <td> $value->quantite </td>
            <td> $value->date_expiration </td>
            <td class="d-flex justify-content-around">
                    <button onclick="addToCartProduct($value->id)"  type="submit" class="btn btn-sm btn-primary">+ Ajouter aux pannier</button>

            </td>
        </tr>
        EOD;
        }

        return $body;

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
