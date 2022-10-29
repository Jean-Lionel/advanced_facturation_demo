<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Entreprise;
use App\Models\ObrDeclaration;
use App\Http\Requests\StoreObrDeclarationRequest;
use App\Http\Requests\UpdateObrDeclarationRequest;

class ObrDeclarationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = Order::all();
        return view('obr_declarations.index', [
            'orders' => $orders
        ]);
    }

    public function sendInvoinceToObr($invoince_id){

        $obr = new SendInvoiceToOBR();
        $order = Order::find($invoince_id);
        $invoince = $this->generateInvoince($order);
        $response = $obr->addInvoice($invoince);

        return $response;

    }

    private function generateInvoince($order){

        $invoice_number ="lion". str_pad($order->id, 6, "0", STR_PAD_LEFT);
        $company = Entreprise::latest()->first();

    

        $d = date_create($order->date_facturation);

        $date_facturation = date_format($d, 'YmdHis');
        $invoice_date = date_format($d, 'Y-m-d H:i:s');

        $invoice_signature = $company->tp_TIN."/". env('OBR_USERNAME') 
        ."/". $date_facturation."/".$invoice_number;
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
                    "item_total_amount" => $product['item_total_amount'] ?? 0
                ];
        }


        $invoince =[
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
            "customer_name" =>  $order->client?->name,
            "customer_TIN" => "",
            "customer_address" => $order->client?->addresse,
            "vat_customer_payer" => $order->client?->vat_customer_payer,
            "invoice_type" => "FN",
            "cancelled_invoice_ref" => "",//yyyyMMddHHmmss
            "invoice_signature" => $invoice_signature ,
            "invoice_signature_date" => $invoice_date,
            "invoice_items" =>  $invoinces_items
           
        ];
       // dd($invoince);

        return   $invoince;

    }
}
