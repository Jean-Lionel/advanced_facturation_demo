<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public $currentTax = 18;

    public function __construct(){
        $this->currentTax = \Request::get('current_tva') ?? 18;
    }
    public function index()
    {
        //
        $paniers = Cart::content();

        return view('cart.index', compact('paniers'));
    }

    public function vente(){

        return view('cart.vente');
    }

    public function update_product_price(){

        $rowId = \Request::get('product_id');
        $price = \Request::get('price');

        $total = Cart::subtotal();
       // dd($total );
        $cart = Cart::update($rowId, ['price' => $price]);
        $taux_pourcentage = \Request::get('current_tva') ?? 18;
        $tax = Cart::subtotal() * $taux_pourcentage / 100;

        return response()->json( [
            'rowId' =>  $cart->rowId,
            'cart' => $cart->subtotal(),
            'prix_hors_tva' => getPrice(Cart::subtotal()),
            'total_montant' => getPrice(round($tax + Cart::subtotal())) ,
            'prix_hors_tax' => getPrice(round($tax)),
            'currentTax' => $this->currentTax,


        ]);
        //return  Cart::update($rowId, ['price' => $price]);
    }
    public function update_emballage(){
        $rowId = \Request::get('product_id');
        $unite_emballage = \Request::get('embalage');
        $taux_pourcentage = \Request::get('current_tva');

        $total = Cart::subtotal();
        $cart = Cart::update($rowId, ['options' => [
            'embalage' => $unite_emballage
        ]]);
        $taux_pourcentage = \Request::get('current_tva') ?? 18;
        $tax = Cart::subtotal() * $taux_pourcentage / 100;

        return response()->json( [
            'rowId' =>  $cart->rowId,
            'cart' => $cart->subtotal(),
            'prix_hors_tva' => getPrice(Cart::subtotal()),
            'total_montant' => getPrice(round($tax + Cart::subtotal())) ,
            'prix_hors_tax' => getPrice(round($tax)),
            'currentTax' => $this->currentTax,

        ]);
        //return  Cart::update($rowId, ['price' => $price]);
    }



    public function store(Request $request)
    {
        $diplucata = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id == $request->id;
        });

        if($diplucata->count()){
            return redirect()->route('ventes.index')->with('success', 'Le produit existe déjà ');
        }
        $product = Product::where('id',$request->id)->firstOrFail();
        Cart::add($product->id, $product->name, 1, $product->price,
            [
                'embalage' => BASE_UNITE_EMBALLAGE
            ])->associate('App\Models\Product');
        return response()->json([
            'success' => 'Le produit a été bien ajouter',
            'currentTax' => $this->currentTax
        ]);
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function updatePanier(Request $request){

        $data = $request->all();
        $validate = Validator::make($data, [
            'qty' => 'required|numeric'

        ]);

        if($validate->fails()){
           Session::flash('error', 'Les donneés ne sont pas correctes');
           return response()->json(['error','error']);
       }
       Cart::update($data['rowId'], $data['qty']);
       Session::flash('success', 'La quatite a été bien mise à jour');
       return response()->json(['success','réussi']);
   }

    public function update(Request $request, $rowId)
    {
        return response()->json(['success','resussi']);
    }

    public function update_quantite(){
        // rowId,
        $rowId = \Request::get('rowId');
        $quatite = \Request::get('qty');
        $qte = 1;
        if(floatval($quatite) != 0){
            $qte =  intval($quatite);
        }
        $cart = Cart::update($rowId, $qte );
        $taux_pourcentage = \Request::get('current_tva') ?? 18;
        $tax = Cart::subtotal() * $taux_pourcentage / 100;

        return response()->json( [
            'rowId' => $cart->rowId,
            'cart' => $cart->subtotal(),
            'prix_hors_tva' => getPrice(Cart::subtotal()),
            'total_montant' => getPrice(round($tax + Cart::subtotal())) ,
            'prix_hors_tax' => getPrice(round($tax)),
            'currentTax' => $this->currentTax,

        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {

        Cart::remove($rowId);

        return back()->with('success', 'Suppression avec success');
    }



}
