<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Models\ObrPointer;
use App\Models\ObrRequestBody;
use Illuminate\Support\Facades\Http;

class SendInvoiceToOBR extends Controller
{
    //
    //private string $baseUrl = 'http://41.79.226.28:8345/ebms_api/';
    //private string $baseUrl = 'https://ebms.obr.gov.bi:8443/ebms_api/';
   //private string $baseUrl = 'https://ebms.obr.gov.bi:9443/ebms_api/';
    private string $baseUrl ;

    public function __construct()
    {
        //     $username = env('OBR_USERNAME', 'ws400000480600270');
        // $password = env('OBR_PASSWORD', '_B_/BGv0');
        //     $req =  Http::acceptJson()->post($this->baseUrl.'login/', [
        //        'username' => $username,
        //        'password' => $password
        //    ]);
        //     dd($req->body());
        // 4002060640
        // dump($this->checkTin("4001183237"));
        $this->baseUrl = env('OBR_PRODUCTION', false) == true ? 'https://ebms.obr.gov.bi:8443/ebms_api/' : 'https://ebms.obr.gov.bi:9443/ebms_api/';
    }

    public function addStockMovement($data){
        $token = $this->getToken();
        // Item
        $data = array_merge(
            [
                "system_or_device_id" => env('OBR_USERNAME'),
            ],
            $data
        );
        $req = Http::withToken($token)->acceptJson()->post($this->baseUrl . 'AddStockMovement/', $data);
       // dd();
        return $req->body();
    }
    public function checkTin(string $tp_TIN)
    {
        $token = $this->getToken();
        // Enlevement des espaces
        $tp_TIN = trim($tp_TIN);
        $req = Http::withToken($token)->acceptJson()->post($this->baseUrl . 'checkTIN/', [
            'tp_TIN' => $tp_TIN
        ]);
        return json_decode($req->body());
    }



    public function cancelInvoice($invoice_signature, $motif)
    {
        $token = $this->getToken();
        $invoice_signature = trim($invoice_signature);

        $arrayString =  explode('/', $invoice_signature);
        $invoice_id = end($arrayString);

        ObrRequestBody::create([
            'invoice_id' =>  $invoice_id ,
            'request_body' => json_encode([
                "invoice_identifier" => $invoice_signature,
                "cn_motif" => $motif
            ]),
        ]);
        $req = Http::withToken($token)->acceptJson()->post($this->baseUrl . 'cancelInvoice/', [
            "invoice_identifier" => $invoice_signature,
           "cn_motif" => $motif
        ]);

        $response = json_decode($req->body());

        ObrPointer::create([
            'order_id' =>   $invoice_id ,
            'invoice_signature' => $invoice_signature,
            'status' => $response->success,
            'electronic_signature' => $invoice_signature,
            'msg' =>  $response->msg,
            'result' => "X",
        ]);
        return $response;
    }


    public function addInvoice($invoince)
    {
        $token = $this->getToken();
       // https://ebms.obr.gov.bi:9443/ebms_api
        ObrRequestBody::create([
            'invoice_id' => $invoince['invoice_number'],
            'request_body' => json_encode($invoince),
        ]);
        $req = Http::withToken($token)->acceptJson()->post($this->baseUrl . 'addInvoice_confirm/', $invoince);
        return json_decode($req->body());
    }

//    public function cancelInvoince($invoince_signature)
//    {
//        $token = $this->getToken();
//        $req = Http::withToken($token)->acceptJson()->post($this->baseUrl . 'cancelInvoice/', [
//            'invoice_signature' => $invoince_signature
//        ]);
//        $response = json_decode($req->body());
//
//        return $response ;
//
//    }

    public static function getInvoinceSignature($invoince_id, $created_at)
    {
        $company = Entreprise::latest()->first();
        $invoice_number = str_pad($invoince_id, 6, "0", STR_PAD_LEFT);
        $d = date_create($created_at);
        $date_facturation = date_format($d, 'YmdHis');

        $invoice_signature = $company->tp_TIN . "/" . env('OBR_USERNAME')
            . "/" . $date_facturation . "/" .INVOICE_PREFIX. $invoice_number;

        return $invoice_signature;

    }

    // Get Invoince

    public function getInvoice($invoice_signature)
    {
        $token = $this->getToken();
        $req = Http::withToken($token)->acceptJson()->post($this->baseUrl . 'getInvoice/', [
            'invoice_signature' => $invoice_signature
        ]);
        $response = json_decode($req->body());
        $success = $response->success;
        $message = $response->msg;

        return  $response;
    }

    // Generation du TOken
    public function getToken()
    {

        try {
            $req = Http::acceptJson()->post($this->baseUrl . 'login/', [
                'username' => env('OBR_USERNAME'),
                'password' => env('OBR_PASSWORD')
            ]);
            $response = json_decode($req->body());
            $success = $response->success;
            $message = $response->msg;
            $token = "";
            if ($success) {
                return $response->result->token;
            }
            return [
                'succees' => false,
                'response' => $req->body(),
                "data" => [
                    'username' => env('OBR_USERNAME'),
                    'password' => env('OBR_PASSWORD') ,
                    'url' => $this->baseUrl
                ]
            ];
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}
