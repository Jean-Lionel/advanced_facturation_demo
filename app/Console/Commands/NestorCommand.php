<?php

namespace App\Console\Commands;

use App\Http\Controllers\SendInvoiceToOBR;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class NestorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:nestor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $obr = new SendInvoiceToOBR();
        // Cherche un Token 
        $token = $obr->getToken();
        $req = Http::withoutVerifying()->withToken($token)->acceptJson()->post('https://ebms.obr.gov.bi:9443/ebms_api/getDmcItems/',
        [
            "nif" => env('OBR_NIF'),
            "reference_dmc" => "2025BIPORC7415"
        ]);

        dump( $req->body());

        // Send Foramtted Stock Mouvement to OBR
       // return json_decode($req->body());

          // Recuparationi

         
    }
}
