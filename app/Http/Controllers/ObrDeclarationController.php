<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
        $oder = Order::find($invoince_id);
        $invoince = $this->generateInvoince($oder);

        $response = $obr->addInvoice($invoince);

        return $response;

    }

    private function generateInvoince($oder){

        $invoice_number = str_pad($oder->id, 6, "0", STR_PAD_LEFT);
        $invoice_signature = "4002060640/". env('OBR_USERNAME') ."/20211206000000/".$invoice_number;

        $invoince =[
            "invoice_number" => $invoice_number,
            "invoice_date" => "2021-12-06 00:00:00",
            "tp_type" => "1",
            "tp_name" => "NDIKUMANA JEAN MARIE",
            "tp_TIN" => "4002060640",
            "tp_trade_number" => "3333",
            "tp_postal_number" => "3256",
            "tp_phone_number" => "79959590",
            "tp_address_commune" => "BUJUMBURA",
            "tp_address_quartier" => "GIKUNGU",
            "tp_address_avenue" => "MUYINGA",
            "tp_address_number" => "",
            "vat_taxpayer" => "1",
            "ct_taxpayer" => "0",
            "tl_taxpayer" => "0",
            "tp_fiscal_center" => "DGC",
            "tp_activity_sector" => "SERVICE MARCHAND",
            "tp_legal_form" => "suprl",
            "payment_type" => "1",
            "customer_name" => "NGARUKIYINTWARI WAKA",
            "customer_TIN" => "4000202020",
            "customer_address" => "KIRUNDO",
            "vat_customer_payer" => "1",
            "invoice_type" => "FN",
            "cancelled_invoice_ref" => "",//yyyyMMddHHmmss
            "invoice_signature" => $invoice_signature ,
            "invoice_signature_date" => "2021-12-06 00:00:00",
            "invoice_items" => [
                [
                    "item_designation" => "10",
                    "item_quantity" => "10",
                    "item_price" => "500",
                    "item_ct" => "0",
                    "item_tl" => "0",
                    "item_price_nvat" => "5000",
                    "vat" => "18",
                    "item_price_wvat" => "5900",
                    "item_total_amount" => "5900",

                ],
                [
                    "item_designation" => "45",
                    "item_quantity" => "10",
                    "item_price" => "200",
                    "item_ct" => "0",
                    "item_tl" => "0",
                    "item_price_nvat" => "90000",
                    "vat" => "18",
                    "item_price_wvat" => "106200",
                    "item_total_amount" => "106200",

                ]
            ]
        ];

        return   $invoince;

    }
}
