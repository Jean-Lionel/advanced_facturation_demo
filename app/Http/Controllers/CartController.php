<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public $currentTax = 18;

    public function __construct(){
        $this->currentTax =  18;
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

    public function editCanceledInvoice(Order $order)
    {
        if (! $order->is_cancelled) {
            return redirect()->route('canceledInvoince')
                ->with('error', 'La modification est autorisée seulement pour une facture annulée.');
        }

        Cart::destroy();
        $missingProducts = 0;

        foreach ($order->products ?? [] as $item) {
            $product = Product::find($item['id'] ?? null);

            if (! $product) {
                $missingProducts++;
                continue;
            }

            $taxRate = $product->taux_tva ?? 0;

            Cart::add(
                $product->id,
                $product->name,
                $item['quantite'] ?? 1,
                $item['price'] ?? $product->price,
                [
                    'embalage' => $item['embalage'] ?? BASE_UNITE_EMBALLAGE,
                    'taxRate' => $taxRate,
                ]
            )->associate(Product::class)
                ->setTaxRate($taxRate);
        }

        if (Cart::count() <= 0) {
            return redirect()->route('canceledInvoince')
                ->with('error', 'Impossible de préparer la modification : aucun produit de cette facture n’a été retrouvé.');
        }

        $client = Client::find($order->client_id);
        $clientFromInvoice = $order->client ? (array) $order->client : [];

        Session::put('editing_canceled_invoice', [
            'order_id' => $order->id,
            'invoice_signature' => $order->invoice_signature,
            'type_paiement' => $order->type_paiement,
            'invoice_currency' => $order->invoice_currency,
            'banque_id' => $order->banque_id,
            'commissionaire_id' => $order->commissionaire_id,
            'client' => [
                'id' => $order->client_id,
                'name' => $client->name ?? ($clientFromInvoice['name'] ?? ''),
                'telephone' => $client->telephone ?? ($clientFromInvoice['telephone'] ?? ''),
                'customer_TIN' => $client->customer_TIN ?? ($clientFromInvoice['customer_TIN'] ?? ''),
                'addresse' => $client->addresse ?? ($clientFromInvoice['addresse'] ?? ''),
            ],
        ]);

        $message = 'La facture annulée #' . $order->id . ' est prête à être modifiée. Validez pour créer une nouvelle facture.';

        if ($missingProducts > 0) {
            $message .= ' Attention : ' . $missingProducts . ' produit(s) introuvable(s) n’ont pas été ajoutés.';
        }

        return redirect()->route('panier.index')->with('success', $message);
    }

    public function update_product_price(){

        $rowId = request()->get('product_id');
        $price = request()->get('price');

        $total = Cart::subtotal();
       // dd($total );
        $cart = Cart::update($rowId, ['price' => $price]);
        //$taux_pourcentage = request()->get('current_tva') ?? 18;
        $tax = Cart::tax();

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
        $rowId = request()->get('product_id');
        $unite_emballage = request()->get('embalage');
        $taux_pourcentage = request()->get('current_tva');

        $total = Cart::subtotal();
        $cart = Cart::update($rowId, ['options' => [
            'embalage' => $unite_emballage
        ]]);
       // $taux_pourcentage = request()->get('current_tva') ?? 18;
        $tax = Cart::tax();

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
                'embalage' => BASE_UNITE_EMBALLAGE,
                'taxRate' => $product->taux_tva
            ])->associate('App\Models\Product')
            ->setTaxRate($product->taux_tva);
            $vente = new VenteController();

        return response()->json([
            'success' => 'Le produit a été bien ajouter',
            'currentTax' => $this->currentTax,
            'panier' => $vente->panierContent()
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
        $rowId = request()->get('rowId');
        $quatite = request()->get('qty');
        $qte = 1;
        if(floatval($quatite) != 0){
            $qte =  floatval($quatite);
        }
        $cart = Cart::update($rowId, $qte );
       // $taux_pourcentage = request()->get('current_tva') ?? 18;
        $tax = Cart::tax();
        return response()->json( [
            'rowId' => $cart->rowId,
            'cart' => $cart->subtotal(),
            'prix_hors_tva' => getPrice(Cart::subtotal()),
            'total_montant' => getPrice(round($tax + Cart::subtotal())) ,
            'prix_hors_tax' => getPrice(round($tax)),
            'currentTax' => $this->currentTax,

        ]);
    }


    public function destroy($rowId)
    {

        Cart::remove($rowId);

        if(request()->ajax()){
            return response()->json([
                'status' => 200,
                'panier' => VenteController::panierContent(),
            ]);
        }
        return back();
    }



}
