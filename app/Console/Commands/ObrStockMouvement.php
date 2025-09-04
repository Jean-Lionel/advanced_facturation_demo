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
        $obr = new SendInvoiceToOBR();

        $movement = ObrMouvementStock::latest()->first();
        $response = $obr->addStockMovementImporters($movement->toArray());

        dump($response);
        return 0;
    }
}
