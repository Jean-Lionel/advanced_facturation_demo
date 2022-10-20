<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SendInvoiceToOBR extends Controller
{
    //
    private string $baseUrl = 'http://41.79.226.28:8345/ebms_api/';

    public function __construct(){
        dump($this->checkTin("4000235782"));
        dd("je suis");
    }


    public function checkTin(string $tp_TIN){
        $token = $this->getToken();
        $req =  Http::withToken($token)->acceptJson()->post($this->baseUrl.'checkTIN/',[
            'tp_TIN' => $tp_TIN
        ]);
        $response = json_decode($req->body());

        return $response;
    }


    public function addInvoice(){

        $invoince = [
            'invoice_number' => '',
            'invoice_date' => '',
            'tp_type' => '2',
            'tp_name' => 'DUKORE TECK',
            'tp_TIN' => 'DUKORE TECK',
            'tp_trade_number' => 'DUKORE TECK',
            'tp_postal_number' => 'DUKORE TECK',
            'tp_phone_number' => 'DUKORE TECK',
            'tp_phone_number' => 'DUKORE TECK',
            'tp_address_commune' => 'DUKORE TECK',
            'tp_address_quartier' => 'DUKORE TECK',
            'tp_address_avenue' => 'DUKORE TECK',
            'tp_address_number' => 'DUKORE TECK',
            'vat_taxpayer' => 'DUKORE TECK',
            'ct_taxpayer' => 'DUKORE TECK',
            'tl_taxpayer' => 'DUKORE TECK',
            'tp_fiscal_center' => 'DUKORE TECK',
            'tp_activity_sector' => 'DUKORE TECK',
            'tp_legal_form' => 'DUKORE TECK',
            'invoince_item' => 'DUKORE'
        ];
        $req =  Http::withToken($token)->acceptJson()->post($this->baseUrl.'addInvoice/',[
            'invoice_signature' => $invoice_signature
        ]);
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
