<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SendInvoiceToOBR extends Controller
{
    //
    private string $baseUrl = 'http://41.79.226.28:8345/ebms_api/';

    public function __construct(){
        // 4002060640
        //dump($this->checkTin("4000235731"));
        dump($this->addInvoice());
        dd("je suis");
    }
    public function checkTin(string $tp_TIN){
        $token = $this->getToken();
        // Enlevement des espaces
        $tp_TIN = trim($tp_TIN);
        $req =  Http::withToken($token)->acceptJson()->post($this->baseUrl.'checkTIN/',[
            'tp_TIN' => $tp_TIN
        ]);
        $response = json_decode($req->body());

        if( $response->success){
            // Nom du contribuable 
            return [
                'success' => true,
                'tp_TIN' => $response->result->taxpayer[0]->tp_name
            ];
        }
        return  [
            'success' => false,
            'msg' => $response->msg
        ];
    }


    public function addInvoice(){

        $invoince =[
            "invoice_number" => "00001",
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
            "invoice_signature" => "4002060640/ws400206064000267/20211206000000/00001",
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

        $token = $this->getToken();
        $req =  Http::withToken($token)->acceptJson()->post($this->baseUrl.'addInvoice/',$invoince);
        return $req->body();
    }

    // Get Invoince 

    public function getInvoice($invoice_signature){
        $token = $this->getToken();
        $req =  Http::withToken($token)->acceptJson()->post($this->baseUrl.'getInvoice/',[
            'invoice_signature' => $invoice_signature
        ]);
        $response = json_decode($req->body());
        $success = $response->success;
        $message = $response->msg;

        return $message;
    }

    // Generation du TOken
    public function getToken(string $username ='ws400206064000267',string $password ='69l_Gy6H') 
    {
        $req =  Http::acceptJson()->post($this->baseUrl.'login/', [
            'username' => $username,
            'password' => $password
        ]);
        $response = json_decode($req->body());
        $success = $response->success;
        $message = $response->msg;
        $token = "";
        if($success ){
          $token = $response->result->token; 
        }

      return $token;
  }
}
