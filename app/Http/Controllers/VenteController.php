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
        // if(env('OBR_CHECKCONNECTIVITY', false)){
        //     $obr = new SendInvoiceToOBR();
        //     dump($obr->getInvoice('4000004806/wsl400000480600187/20240417143348/000025'));
        //     dd($obr->getToken());
        // }
        // dd($obr->getInvoice('4000604456/ws400060445600690/20240327160753/000012'));
        $search = request()->get('search');
        $products = Product::where('quantite', '>', 0)
                    ->where('price', '>', 0)
                    ->whereNotIn('id', Cart::content()->map->id)
                    ->where(function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('code_product', 'like', '%' . $search . '%')
                        ->orWhere('price', 'like', '%' . $search . '%')
                        ->orWhere('unite_mesure', 'like', '%' . $search . '%');
                    })->latest()->take(25)->get();
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

        foreach ($products as $key => $value){
            $key++;
            $body .= <<<EOD
            <tr>
            <td class="col-center">{$key}</td>
            <td>{$value->code_product}</td>
            <td>{$value->name} [{$value->unite_mesure}]</td>
            <td class="col-num">{$value->price}</td>
            <td class="col-num">{$value->taux_tva}</td>
            <td class="col-num">{$value->price_tvac}</td>
            <td class="col-num">{$value->quantite}</td>
            <td>{$value->date_expiration}</td>
            <td class="col-action">
            <button type="button" onclick="addToCartProduct({$value->id})" class="btn btn-sm btn-primary btn-add" title="Ajouter au panier">+</button>
            </td>
            </tr>
            EOD;
        }

        return $body;

    }


    public  static function panierContent(){
        $body = '<div class="fixTableHead vente-table-wrap"><table class="table table-sm vente-table">
        <thead>
        <tr>
            <th>Produit</th>
            <th class="col-num">Prix</th>
            <th class="col-num">Quantite</th>
            <th class="col-action">Supprimer</th>
        </tr>
        </thead>
        <tbody id="panier_content">
        ';

        if (Cart::content()->isEmpty()) {
            $body .= '<tr><td colspan="4" class="vente-cart-empty">Aucun produit dans le panier</td></tr>';
        }

        foreach (Cart::content() as $product){
            $price = getPrice($product->model->price);
            $qty = $product->qty;
            $body .= <<<EOD
            <tr>
            <td>{$product->name}</td>
            <td class="col-num">{$price}</td>
            <td class="col-num">{$qty}</td>
            <td class="col-action"><button type="button" onclick="removeToContent('{$product->rowId}')" class="btn btn-sm btn-danger btn-remove" title="Supprimer"><i class="fa fa-trash"></i></button></td>
            </tr>
            EOD;
        }

        $body .= '</tbody></table></div>';

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
