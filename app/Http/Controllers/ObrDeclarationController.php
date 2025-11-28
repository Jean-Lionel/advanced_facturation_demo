<?php

namespace App\Http\Controllers;

use App\Models\CanceledInvoince;
use App\Models\ObrMouvementStock;
use App\Models\Order;
use App\Models\Entreprise;
use App\Models\ObrPointer;
use App\Models\Product;
use App\Models\OrderInteret;
use App\Models\Compte;
use App\Models\BienvenuHistorique;
use Illuminate\Http\Request;
use App\Http\Controllers\SendInvoiceToOBR;
use Illuminate\Support\Facades\DB;

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
        $orders = Order::whereNull('envoye_obr')->latest()->paginate();
        return view('obr_declarations.index', [
            'orders' => $orders
        ]);
    }

    public function hostory()
    {
        $order_id = request()->query('order_id');
        $orders = Order::with(['concelInvoice'])->whereNotNull('envoye_obr')
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

        $order = Order::where('invoice_signature', '=', $request->invoice_signature)->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'msg' => 'Facture introuvable.'
            ]);
        }

        try {
            DB::beginTransaction();

            if (env('APP_CAN_CALCULE_INTERET', false)) {
                $this->removeInterestsFromOrder($order);
            }

            if ($request->cancel_amount) {
                foreach ($order->products as $productItem) {
                    $product = Product::find($productItem['id']);

                    if ($product) {

                        \App\Models\RetourProduit::create([
                            'product_id' => $product->id,
                            'item_name' => $product->name,
                            'order_id' => $order->id,
                            'quantite' => $productItem['quantite'],
                            'description' => $request->motif,
                            'user_id' => auth()->user()->id ?? 1,
                        ]);

                        $current_price = $productItem['price_revient'] ?? 0;
                        ObrMouvementStock::saveMouvement(
                            $product,
                            'ER',
                            $current_price,
                            $productItem['quantite'],
                            $request->motif,
                            $order->id
                        );

                        $product->quantite += $productItem['quantite'];
                        $product->save();
                    }
                }
            }

            $cancelInvoice = CanceledInvoince::create([
                'motif' => $request->motif,
                'invoice_signature' => $request->invoice_signature,
                'created_at' => now(),
                'status' => false,
                'order_id' => $order->id,
            ]);

            // if (!isInternetConnection() || env('OBR_CAN_SYNCRONISE', true)) {
            if (true) {
                $order->canceled_or_connection = 'ANNULEE HORS CONNECTION';
                $order->is_cancelled = true;
                $order->save();
                $cancelInvoice->status = false;
                $cancelInvoice->save();

                DB::commit();

                return response()->json([
                    'success' => true,
                    'msg' => 'La facture a été annulée.',
                    'invoice_signature' => $request->invoice_signature
                ]);
            } else {
                $obr = new SendInvoiceToOBR();
                $response = $obr->cancelInvoice($request->invoice_signature, $request->motif);

                $order->is_cancelled = true;
                $order->save();
                $cancelInvoice->status = true;
                $cancelInvoice->save();

                DB::commit();

                return $response;
            }

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'msg' => $e->getMessage() . ' FILE ' . $e->getFile() . ' LINE ' . $e->getLine()
            ], 500);
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
        // Modification de l'id de l'invoice
        $invoince_id = getInvoiceNumber($invoince_id);
        $invoince = $this->generateInvoince($order, $company, $invoince_id, $invoice_signature, $order->created_at);
        $response = null;


       // die($invoince);
        try {
            $response = $obr->addInvoice($invoince);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'success' => false,
                'msg' => $e->getMessage(). ' FILE ' . $e->getFile() . ' LINE ' .$e->getLine()
            ]);
        }

        // Si la facture a été envoyé
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
            if (isset($response->success) && $response->success) {
                $customer_TIN = $order->client->customer_TIN;
            }
        }
        $invoince = [
            "invoice_id" => $order->id,
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
            "invoice_ref" => $order->invoice_ref ? getInvoiceNumber($order->invoice_ref) : "",
            //yyyyMMddHHmmss
            "invoice_signature" => $invoice_signature,
            "invoice_identifier" => $invoice_signature,
            "invoice_signature_date" => $invoice_signature_date,
            "invoice_items" => $invoinces_items
        ];

        return $invoince;

    }

    private function removeInterestsFromOrder($order)
    {
        $orderInteret = OrderInteret::where('order_id', $order->id)->first();

        if (!$orderInteret) {
            return;
        }

        $description = json_decode($orderInteret->description, true);
        $partage = $description['partage'] ?? [];

        $montantInformaticien = $partage['Informaticien'] ?? 0;
        $montantClient = $partage['Client'] ?? 0;
        $montantCommissionnaire = $partage['Commisionnaire'] ?? 0;
        $montantEntreprise = $partage['Entreprise'] ?? 0;

        if ($order->commissionaire_id && $montantCommissionnaire > 0) {
            $compteCommissionnaire = Compte::where('client_id', $order->commissionaire_id)->first();

            if ($compteCommissionnaire) {
                $compteCommissionnaire->montant -= $montantCommissionnaire;
                $compteCommissionnaire->save();

                BienvenuHistorique::create([
                    'compte_id' => $compteCommissionnaire->id,
                    'client_id' => $order->commissionaire_id,
                    'mode_payement' => 1,
                    'title' => 'ANNULATION COMMISSION',
                    'montant' => -$montantCommissionnaire,
                    'description' => "REF #" . $orderInteret->id . " Annulation commission sur vente - Facture Client No" . $order->client_id,
                    'user_id' => auth()->user()->id ?? 1
                ]);
            }
        }

        if ($order->client_id && $montantClient > 0) {
            $compteClient = Compte::where('client_id', $order->client_id)->first();

            if ($compteClient) {
                $compteClient->montant -= $montantClient;
                $compteClient->save();

                BienvenuHistorique::create([
                    'compte_id' => $compteClient->id,
                    'client_id' => $order->client_id,
                    'mode_payement' => 1,
                    'title' => 'ANNULATION RESTOURNE',
                    'montant' => -$montantClient,
                    'description' => "REF #" . $orderInteret->id . " Annulation restourne sur achat - Facture Client No" . $order->client_id,
                    'user_id' => auth()->user()->id ?? 1
                ]);
            }
        }
        $description['partage'] = [
            'Informaticien' => 0,
            'Client' => 0,
            'Commisionnaire' => 0,
            'Entreprise' => 0,
        ];
        $orderInteret->description = json_encode($description);
        $orderInteret->save();
    }

}
