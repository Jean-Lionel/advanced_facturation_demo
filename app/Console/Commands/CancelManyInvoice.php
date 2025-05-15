<?php

namespace App\Console\Commands;

use App\Http\Controllers\ObrDeclarationController;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class CancelManyInvoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoince:cancel';

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
        $invoices =  Order::where('created_at', '<', '2025-05-01')->get();

        foreach($invoices as $invoice){
            $obr = new ObrDeclarationController();
            // add request
            $request = new Request();
            $request->merge([
                'invoice_signature' => $invoice->invoice_signature,
                'motif' => '# '. $invoice->id .' Annulation de la facture des factures des dattes inferieur au 1 Mai 2025',
                'cancel_amount' => true,
            ]);
            $obr->cancelInvoice($request);
            echo "Annulation de la facture " . $invoice->invoice_signature . "\n";

            $invoice->delete();
        }

        echo "Je suis en bonne et du forme";
        return 0;
    }
}
