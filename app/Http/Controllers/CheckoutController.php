<?php

namespace App\Http\Controllers;


use App\Jobs\SyncroniseInvoice;
use App\Models\Entreprise;
use App\Models\ObrMouvementStock;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Models\DetailOrder;
use Illuminate\Http\Request;
use App\Models\FollowProduct;
use App\Models\PaiementDette;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\SendInvoiceToOBR;

class CheckoutController extends Controller
{


    public function store(Request $request)
    {
        $validate =
        [
            'name' => 'required|min:1',
            // 'date_facturation' => 'required',
        ];
        if ($request->customer_TIN) {
            // code...
            $validate['customer_TIN'] = 'required|exists:clients';
        }
        $request->validate($validate);
        if (Cart::count() <= 0) {
            Session::flash('error', 'Votre panier est vide.');
            return redirect()->route('panier.index');
        }
        if ($this->noLongerStock()) {
            Session::flash('error', 'Un produit de votre panier ne se trouve plus en stock.');
            return redirect()->route('panier.index');
        }

        $order = null;
        try {
            DB::beginTransaction();
            $this->stockUpdated();
            $client =  Client::find($request->clientNumber);
            if(!$client) {
                $client =  Client::create([
                    'name' => $request->name,
                    'telephone' => $request->telephone ?? "0000",
                    'description' =>  "",
                    'addresse' => $request->addresse_client ?? "",
                    'customer_TIN' => $request->customer_TIN ?? "",
                    'vat_customer_payer' => $request->vat_customer_payer ? 1 : 0,
                ]);
            }
            $cartInfo = $this->extractCart();
            $nombre_sac = array_sum(array_column($cartInfo, 'nombre_sac'));
            $oder_signuture = "";
            $company = Entreprise::currentEntreprise();
          //  dd($company);
            $tax = round(Cart::subtotal() *   $request->currentTva / 100);
            $order = Order::create([
                'amount' => round( $tax  + Cart::subtotal()),
                'total_quantity' => Cart::count(),
                'total_sacs' => $nombre_sac,
                'tax' => $tax,
                'type_paiement' => $request->type_paiement,
                'amount_tax' => round(Cart::subtotal()),
                'products'=> serialize($cartInfo),
                'client'=> $client->toJson(),
                'addresse_client'=> $request->addresse_client,
                'date_facturation'=> now(),
                'is_cancelled' => 0,
                'company' =>  $company->toJson(),
            ]);
            $signature = SendInvoiceToOBR::getInvoinceSignature($order->id,$order->created_at);
            $order->invoice_signature = $signature;
            foreach ($cartInfo as $key => $item) {
                $product = Product::find($item['id']);
                ObrMouvementStock::saveMouvement(
                    $product,
                    'SN',
                    $product->price_max, // Prix de reviens
                    $item['quantite'],
                    NULL,
                    $order->id,
                );
            }

            $order->save();
            $this->storeTodetailOder($order->id);
            // SEND INVOINCES TO OBR
            if($request->type_paiement == 'DETTE'){
                //Enregistre les infos dans les dettes
                PaiementDette::create([
                    'montant' => Cart::total() ,
                    'montant_restant' =>Cart::total() ,
                    'order_id' =>   $order->id ,
                    'status' => 'NON PAYE'
                ]);
            }
            Cart::destroy();
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', $e->getMessage());
            return back();

        }

        if(isset($order->id)){
            // Call a JOB
    //        SyncroniseInvoice::dispatch($order->id);
//            $obr = new ObrDeclarationController();
//            try{
//                $obr->sendInvoinceToObr($order->id);
//            }catch(\Exception $e){
//                Session::flash('error', $e->getMessage());
//            }

            return view('cart.facture_model_prothem', compact('order'));
        }
    }

    public function thankyou()
    {
        return Session::has('success') ? view('checkout.thankYou') : redirect()->route('products.index');
    }

    private function noLongerStock()
    {
        foreach (Cart::content() as $item) {
            $product = Product::find($item->model->id);

            if ($item->qty > $product->quantite) {
                return true;
            }
        }
        return false;
    }

    private function stockUpdated()
    {
        foreach (Cart::content() as $item) {
            $product = Product::find($item->model->id);
            $product->update(['quantite' => $product->quantite - $item->qty]);
        }
    }

    private function storeTodetailOder($order_id){
        foreach (Cart::content() as $item) {

            DetailOrder::create([

                'product_id' => $item->model->id,
                'quantite' => $item->qty,
                'quantite_stock'=> $item->model->quantite,
                'price_unitaire' => $item->price,
                'code_product' => $item->model->code_product,
                'name' => $item->name,
                'unite_mesure' => $item->model->unite_mesure,
                'date_expiration' => $item->model->date_expiration,
                'order_id' => $order_id,
                'embalage' => $item->embalage

            ]);


            FollowProduct::create([
                'quantite' => $item->qty,
                'details' => $item->model->toJson(),
                'action' => 'VENTE',
                'product_id' => $item->model->id,
            ]);

        }
    }


    private function extractCart(){
        $products = [];
        foreach (Cart::content() as $item) {
            $v = ($item->price * $item->qty) * $item->taxRate /100;
            $prix_hors_tva =  ($item->price * $item->qty);
            $products[] = [
                'id' => $item->id,
                'name' => $item->name,
                'rowId' => $item->rowId,
                'price' => $item->price,
                'quantite' => $item->qty,
                'nombre_sac' => ($item->qty / $item->options['embalage'] ?? 1 ),
                'embalage' => $item->options['embalage'],
                'item_ct' => 0,
                'item_tl' => 0 ,
                'item_price_nvat' => $prix_hors_tva,
                'vat' => $v,
                'item_price_wvat' => ($v + $prix_hors_tva),
                'item_total_amount' => ($v + $prix_hors_tva)
            ];
        }

        return $products;
    }

    public function paimenetDette(){

        $dettes = PaiementDette::sortable()->where('status','=','NON PAYE')
        ->orWhere('montant_restant','>',0)
        ->paginate();

        $totalDette = PaiementDette::all()->where('montant_restant','>',0)->sum('montant_restant');


        return view('checkout.paimenet_dette', compact('dettes','totalDette'));
    }
}
