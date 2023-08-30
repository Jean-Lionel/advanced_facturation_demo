<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SendInvoiceToOBR extends Controller
{
    //
    //private string $baseUrl = 'http://41.79.226.28:8345/ebms_api/';
    //private string $baseUrl = 'https://ebms.obr.gov.bi:8443/ebms_api/';
   // private string $baseUrl = 'https://ebms.obr.gov.bi:9443/ebms_api/';
    private string $baseUrl = 'https://ebms.obr.gov.bi:8443/ebms_api/';

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
    }

    public function addStockMovement($data){
        $token = $this->getToken();
        // Item
        $data = array_merge(
            [
                "system_or_device_id" => OBR_USERNAME,
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



    public function cancelInvoice($invoice_signature)
    {
        $token = $this->getToken();
        $invoice_signature = trim($invoice_signature);
        $req = Http::withToken($token)->acceptJson()->post($this->baseUrl . 'cancelInvoice/', [
            'invoice_signature' => $invoice_signature
        ]);

        return json_decode($req->body());
    }


    public function addInvoice($invoince)
    {

        $token = $this->getToken();
        $req = Http::withToken($token)->acceptJson()->post($this->baseUrl . 'addInvoice/', $invoince);
        return json_decode($req->body());
    }

    public function cancelInvoince($invoince_signature)
    {

        $token = $this->getToken();
        $req = Http::withToken($token)->acceptJson()->post($this->baseUrl . 'cancelInvoice/', [
            'invoice_signature' => $invoince_signature
        ]);
        return json_decode($req->body());

    }

    public static function getInvoinceSignature($invoince_id, $created_at)
    {
        $company = Entreprise::latest()->first();
        $invoice_number = str_pad($invoince_id, 6, "0", STR_PAD_LEFT);
        $d = date_create($created_at);
        $date_facturation = date_format($d, 'YmdHis');

        $invoice_signature = $company->tp_TIN . "/" . OBR_USERNAME
            . "/" . $date_facturation . "/" . $invoice_number;

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

        return $message;
    }

    // Generation du TOken
    public function getToken()
    {

        try {

            $req = Http::acceptJson()->post($this->baseUrl . 'login/', [
                'username' => OBR_USERNAME,
                'password' => OBR_PASSWORD
            ]);
           // dd($req->body());

            $response = json_decode($req->body());

            $success = $response->success;
            $message = $response->msg;
            $token = "";
            if ($success) {
                $token = $response->result->token;
            }

            return $token;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}
