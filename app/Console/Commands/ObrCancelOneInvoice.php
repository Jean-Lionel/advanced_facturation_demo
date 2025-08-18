<?php

namespace App\Console\Commands;

use App\Http\Controllers\ObrDeclarationController;
use Illuminate\Console\Command;

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
       $resp= $obr->cancelInvoice($invoiceID  , 'Annulation de la facture Car la facture a ete facture deux fois');
       dump($resp);
    }
}
