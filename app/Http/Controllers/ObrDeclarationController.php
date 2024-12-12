<?php

namespace App\Http\Controllers;

use App\Models\CanceledInvoince;
use App\Models\ObrMouvementStock;
use App\Models\Order;
use App\Models\Entreprise;
use App\Models\ObrPointer;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\SendInvoiceToOBR;

class ObrDeclarationController extends Controller
{

    public function syncronizeInvoices(){

        if(isInternetConnection()){
            // check if creditial connection is available to OBR request
            try {
                //code...
                $syncronize = new SyncronizeController();
                $syncronize->syncronizeInvoices();
                $syncronize->syncronizeStock();
            } catch (\Throwable $th) {
                return [
                    "success" => false,
                   // "msg" => $th->getMessage(),
                ];
            }
        }else{
            return [
                "success" => false,
                "msg" => "Pas de connection internet"
            ];

        }
    }

    public function factureAvoir(){
        return view('obr_declarations.facture_avoir');
    }
    public function remboursementCaution(){
        return view('obr_declarations.remboursementCaution');
    }
    public function index()
    {
        $orders = Order::whereNull('envoye_obr')->latest()->get();
        return view('obr_declarations.index', [
            'orders' => $orders
        ]);
    }

    public function hostory()
    {
        $order_id = request()->query('order_id');
        $orders = Order::whereNotNull('envoye_obr')
        ->where( function($query) use ($order_id){
            if(isset($order_id) ){
                $query->where('id', $order_id);
            }
        })
        ->latest()->paginate();
        return view('obr_declarations.history', [
            'orders' => $orders,
            'order_id' => $order_id
        ]);
    }

    public function obr_declarations_cancel()
    {
        $orders = Order::where('is_cancelled' , '<>', 0)->latest()->get();
        return view('obr_declarations.history', [
            'orders' => $orders
        ]);
    }

    public function cancelInvoice(Request $request)
    {

        $request->validate([
            'invoice_signature' => 'required',
            'motif' => 'required',
        ]);
        // Change the Status Of the order
        //    dd($request->cancel_amount);
        $order = Order::where('invoice_signature', '=',$request->invoice_signature)->first();
        if($request->cancel_amount){
            foreach($order->products as $productItem){
                // dd($product);
                try{
                    $product = Product::find($productItem['id']);
                    if($product ){
                        $product->quantite += $productItem['quantite'];
                        $product->save();
                        \App\Models\RetourProduit::create([
                            'product_id' => $product->id,
                            'item_name' => $product->name,
                            'order_id' => $order->id,
                            'quantite' => $productItem['quantite'],
                            'description' => $request->motif,
                            'user_id' => auth()->user()->id,
                        ]);
                        $current_price = $productItem['price_revient'] ;
                        ObrMouvementStock::saveMouvement( $product, 'ER',$current_price, $productItem['quantite'], $request->motif, $order->id);
                    }

                    // Enregistres les mouvements de stock correspondant pour la facture

                  //  $mouvements_enregistres = ObrMouvementStock
                    //
                }catch(\Exception $e){
                    dd( $e);
                }
            }
        }
        if(!isInternetConnection() || !CAN_SYNCRONISE){
            // Add to pading table
            CanceledInvoince::create([
                'motif' => $request->motif,
                'invoice_signature' => $request->invoice_signature,
                'created_at' => now(),
                'status' => false,
                'order_id' => $order->id,
            ]);
            $order->canceled_or_connection = 'ANNULEE HORS CONNECTION';
            $order->is_cancelled = true;
            $order->save();
            return response()->json([
                'success' => true,
                'msg' => 'la Facture a été annulée.',
                'invoice_signature' => $request->invoice_signature
            ]);
        }else{
            $obr = new SendInvoiceToOBR();
            try {
                $response = $obr->cancelInvoice($request->invoice_signature , $request->motif);
                $order = Order::find($request->order_id);
                $order->is_cancelled = true;
                $order->save();
                return $response;
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'msg' => $e->getMessage(). ' FILE ' . $e->getFile() . ' LINE ' .$e->getLine()
                ]);
            }

        }


    }

    public function sendInvoinceToObr($invoince_id)
    {
        $obr = new SendInvoiceToOBR();
        $order = Order::find($invoince_id);
        //DON'T Reapet your self but i did
        $invoice_signature = $order->invoice_signature;
        if (!$order->invoice_signature) {
            $invoice_signature = SendInvoiceToOBR::getInvoinceSignature($order->id, $order->created_at);
        }
        $company = Entreprise::currentEntreprise();
        $invoince = $this->generateInvoince($order, $company, $invoince_id, $invoice_signature, $order->created_at);
        $response = null;
      

       // die($invoince);
        try {
            $response = $obr->addInvoice($invoince);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => "Vérifier que votre ordinateur est connecté"
            ]);
        }
        if ($response->success) {
            $order->envoye_obr = true;
            $order->envoye_par = auth()->user()->id ?? 10000;
            $order->envoye_time = now();
            $order->invoice_signature = $invoice_signature;
            $order->save();
            ObrPointer::create([
                'order_id' => $order->id,
                'invoice_signature' => $invoice_signature,
                'status' => $response->success,
                'electronic_signature' => $response->electronic_signature,
                'result' => json_encode($response->result),
                'msg' => $response->msg,
            ]);
        }else{
            ObrPointer::create([
                'order_id' => $order->id,
                'invoice_signature' => $invoice_signature,
                'status' => $response->success,
                'electronic_signature' => "",
                'result' => "",
                'msg' => $response->msg,
            ]);
        }
        // Si la facture n'a pas été envoyé

        if ($response->msg == "Une facture avec le même numéro existe déjà.") {
            $order->envoye_obr = true;
            $order->envoye_par = auth()->user()->id ?? 10000;
            $order->envoye_time = now();
            $order->invoice_signature = $invoice_signature;
            if ($order->invoice_signature) {
                $order->save();
                ObrPointer::create([
                    'order_id' => $order->id,
                    'invoice_signature' => $invoice_signature,
                    'status' => true,

                ]);
            }
        }
        return $response;

    }

    private function generateInvoince($order, $company, $invoice_number, $invoice_signature, $date_facturation)
    {

        $d = date_create($order->created_at);
        $invoice_signature_date = date_create($order->created_at);

        $invoice_date = date_format($d, 'Y-m-d H:i:s');
        $invoice_signature_date = date_format($invoice_signature_date, 'Y-m-d H:i:s');
        $invoinces_items = [];

        foreach ($order->products as $key => $product) {
            // code...
            $invoinces_items[] = [
                "item_designation" => $product['name'],
                "item_quantity" => $product['quantite'],
                "item_price" => $product['price'],
                "item_ct" => $product['item_ct'] ?? 0,
                "item_tl" => $product['item_tl'] ?? 0,
                "item_price_nvat" => $product['item_price_nvat'] ?? 0,
                "vat" => $product['vat'] ?? 0,
                "item_price_wvat" => $product['item_price_wvat'] ?? 0,
                "item_total_amount" => $product['item_total_amount'] ?? 0,
                "item_tsce_tax" => $product['item_tsce_tax'] ?? 0,
                "item_ott_tax" => $product['item_tsce_tax'] ?? 0,
            ];
        }
        //Check A valide customer_TIN
        $customer_TIN = "";
        if (isset($order->client->customer_TIN)) {
            // code...
            $obr = new SendInvoiceToOBR();
            $response = $obr->checkTin($order->client->customer_TIN);
            if ($response->success) {
                $customer_TIN = $order->client->customer_TIN;
            }
        }
        $invoince = [
            "invoice_number" => $invoice_number,
            "invoice_date" => $invoice_date,
            "tp_type" => $company->tp_type,
            "tp_name" => $company->tp_name,
            "tp_TIN" => $company->tp_TIN,
            "tp_trade_number" => $company->tp_trade_number,
            "tp_postal_number" => $company->tp_postal_number,
            "tp_phone_number" => $company->tp_phone_number,
            "tp_address_commune" => $company->tp_address_commune,
            "tp_address_quartier" => $company->tp_address_quartier,
            "tp_address_avenue" => $company->tp_address_avenue,
            "tp_address_number" => $company->tp_address_number,
            "vat_taxpayer" => $company->vat_taxpayer,
            "ct_taxpayer" => $company->ct_taxpayer,
            "tl_taxpayer" => $company->tl_taxpayer,
            "tp_fiscal_center" => $company->tp_fiscal_center,
            "tp_activity_sector" => $company->tp_activity_sector,
            "tp_legal_form" => $company->tp_legal_form,
            "payment_type" => $company->payment_type,
            "customer_name" => $order->client->name ?? "",
            "customer_TIN" => $customer_TIN,
            "customer_address" => $order->client->addresse ?? "",
            "vat_customer_payer" => $order->client->vat_customer_payer ?? "",
            "invoice_type" =>   $order->invoice_type ?? "FN",
            "cancelled_invoice_ref" => "",
            "invoice_ref" => $order->invoice_ref,
            //yyyyMMddHHmmss
            "invoice_signature" => $invoice_signature,
            "invoice_identifier" => $invoice_signature,
            "invoice_signature_date" => $invoice_signature_date,
            "invoice_items" => $invoinces_items
        ];

        return $invoince;

    }
}
