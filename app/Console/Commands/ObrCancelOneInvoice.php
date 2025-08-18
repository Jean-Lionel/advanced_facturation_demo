<?php

namespace App\Console\Commands;

use App\Http\Controllers\ObrDeclarationController;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class ObrCancelOneInvoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'obr:cancel {invoiceID}';

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
        $invoiceID = $this->argument('invoiceID');
        $obr = new ObrDeclarationController();

        $invoice = Order::where('id', $invoiceID)->first();
            // add request
        $request = new Request();
        $request->merge([
            'invoice_signature' =>  $invoice->invoice_signature,
            'motif' => '# '. $invoiceID .' Annulation de la facture car il a ete facture deux fois',
            'cancel_amount' => true,
        ]);
            $obr->cancelInvoice($request);
            echo "Annulation de la facture " . $invoiceID . "\n";
    }
}
