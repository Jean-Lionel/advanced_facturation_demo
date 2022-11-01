<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SendInvoiceToOBR extends Controller
{
    //
    private string $baseUrl = 'http://41.79.226.28:8345/ebms_api/';

    public function __construct(){
       $this->getToken();
        // 4002060640
      // dump($this->checkTin("4000004806"));

    }
    public function checkTin(string $tp_TIN){
        $token = $this->getToken();
        // Enlevement des espaces
        $tp_TIN = trim($tp_TIN);
        $req =  Http::withToken($token)->acceptJson()->post($this->baseUrl.'checkTIN/',[
            'tp_TIN' => $tp_TIN
        ]);

        return json_decode($req->body());
    }

    public function cancelInvoice($invoice_signature){
        $token = $this->getToken();
        $invoice_signature = trim($invoice_signature);
        $req =  Http::withToken($token)->acceptJson()->post($this->baseUrl.'cancelInvoice/',[
            'invoice_signature' => $invoice_signature
        ]);

        return json_decode($req->body());
    }


    public function addInvoice($invoince){

        $token = $this->getToken();
        $req =  Http::withToken($token)->acceptJson()->post($this->baseUrl.'addInvoice/',$invoince);
        return json_decode($req->body());
    }

    public function cancelInvoince($invoince_signature){

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

           try {
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

          } catch (\Exception $e) {
            throw new \Exception("Vérifier que votre ordinateur est connecté", 1);
          }
    }
}
