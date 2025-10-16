<?php

namespace App\Console\Commands;

use App\Http\Controllers\SendInvoiceToOBR;
use App\Http\Controllers\SyncronizeController;
use App\Models\ObrMouvementStock;
use Illuminate\Console\Command;

class ObrStockMouvement extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'obr:stock-mouvement';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syncronize Stock mouvement to OBR';

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
        // check ITEM

        // $obr = new SendInvoiceToOBR();
        // $item = $obr->getDmcItems("2025BIPORC7157");
        // dd($item);

        $movement = ObrMouvementStock::where("is_importation",1 )
        ->whereNull("is_send_to_obr")
        ->latest()
        ->first();

        $obr = new SendInvoiceToOBR();
         $response = $obr->addStockMovementImporters($movement->toArray());
           dump($response );

        // foreach( $movements as $mouvement ){
        //     $obr = new SendInvoiceToOBR();
        //     $response = $obr->addStockMovementImporters($mouvement->toArray());
        //    dump($response);
        // }

        return 0;
    }
}
