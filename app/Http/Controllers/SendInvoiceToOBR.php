<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SendInvoiceToOBR extends Controller
{
    //
    private string $baseUrl = 'http://41.79.226.28:8345/ebms_api/';

    public function __construct(){
       
      echo($this->getToken());
      dd("je suis");
    }

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
