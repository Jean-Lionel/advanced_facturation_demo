<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SendInvoiceToOBR extends Controller
{
    //

    public function __construct(){
        $req =  Http::acceptJson()->post('http://41.79.226.28:8345/ebms_api/login/', [
                    'username' => 'ws400206064000267',
                    'password' => '69l_Gy6H'
                ]);

        $response = json_decode($req->body());

        dump($response->success);

        dd("je suis un Millionnaire");
    }
}
