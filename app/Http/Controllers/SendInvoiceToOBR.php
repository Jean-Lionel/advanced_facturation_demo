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


    public function addInvoice($invoince){

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
    public function getToken() 
    {
         $username = env('OBR_USERNAME');
         $password = env('OBR_PASSWORD');

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
