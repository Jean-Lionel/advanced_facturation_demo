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

        $movements = ObrMouvementStock::where("is_send_to_obr",0)
        ->latest()
        ->take(100)
        ->get();

        foreach($movements as $v){
            $obr = new SendInvoiceToOBR();
            $response1 = $obr->addStockMovementImporters($v->toArray());
            $response = $obr->addStockMovement($v->toArray());
            dump('Response 1:', $response1);
            dump('Response 2:', $response);
        }
        // foreach( $movements as $mouvement ){
        //     $obr = new SendInvoiceToOBR();
        //     $response = $obr->addStockMovementImporters($mouvement->toArray());
        //    dump($response);
        // }

        return 0;
    }
}
