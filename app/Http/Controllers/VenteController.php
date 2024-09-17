<?php

namespace App\Http\Controllers;

use App\Jobs\SyncroniseInvoice;
use App\Models\Vente;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\SendInvoiceToOBR;
use App\Models\Order;

class VenteController extends Controller
{

    public function index(Request $request)
    {
        // $order = Order::latest()->first();
        // dump($order );
        if(env('OBR_CHECKCONNECTIVITY', false)){
            $obr = new SendInvoiceToOBR();
            dump($obr->getInvoice('4000004806/wsl400000480600187/20240417143348/000025'));
            dd($obr->getToken());
        }
        // dd($obr->getInvoice('4000604456/ws400060445600690/20240327160753/000012'));
        $search = request()->get('search');
        $products = Product::where('quantite', '>', 1)
                    ->where('price', '>', 0)
                    ->whereNotIn('id', Cart::content()->map->id)
                    ->where(function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('code_product', 'like', '%' . $search . '%')
                        ->orWhere('price', 'like', '%' . $search . '%')
                        ->orWhere('unite_mesure', 'like', '%' . $search . '%');
                    })->latest()->take(6)->get();
        // SyncroniseInvoice::dispatch(1);

        //dd($products[0]->priceHorsTva);

        $value_products = $this->makeProductBody($products);

        $paniers_content = $this->panierContent();

        if($request->ajax()){
            return $value_products ;
        }

        return view('ventes.index', compact('products', 'paniers_content', 'value_products', 'search'));
    }


    private  function makeProductBody($products){

        $body = "";

        foreach ($products as $value){
            $body .= <<<EOD
            <tr>
            <td> $value->id </td>
            <td> $value->code_product </td>
            <td> $value->name [ $value->unite_mesure]</td>
            <td> $value->price </td>
            <td> $value->taux_tva </td>
            <td> $value->price_tvac </td>
            <td> $value->quantite </td>
            <td> $value->date_expiration </td>
            <td class="d-flex justify-content-around">
            <button onclick="addToCartProduct($value->id)"  class="btn btn-sm btn-primary" title="Ajouter au panier">+</button>
            </td>
            </tr>
            EOD;
        }

        return $body;

    }


    public  static function panierContent(){
        $body = '<div class="fixTableHead"> <table class="table table-striped table-sm table-bordered">
        <thead>
        <tr><th>Produit</th><th>Prix</th><th>Quantite</th><th>Supprimer</th>
        </tr>
        </thead>
        <tbody id="panier_content">
        ';

        foreach (Cart::content() as $product){
            $price = getPrice($product->model->price);
            $body .= <<< EOD
            </tr>
            <td>$product->name</td>
            <td class="text-right">$price</td>
            <td></td>
            <td><button onclick="removeToContent('{$product->rowId}')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
            </tr>
            EOD;

        }

        $body .= '</tbody></table> </div>';

        return  $body;

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
