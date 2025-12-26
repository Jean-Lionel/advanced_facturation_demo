<?php

namespace App\Console\Commands;

use App\Http\Controllers\ObrDeclarationController;
use App\Http\Controllers\SendInvoiceToOBR;
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
        $invoices =  [
            // list of invoice signatures to cancel
            '4002070029/wsl400207002901251/20251217060550/000001',
            '4002070029/wsl400207002901251/20251217112341/000002',
            '4002070029/wsl400207002901251/20251217115723/000003',
            // Add more invoice signatures as needed
        ];

        foreach($invoices as $invoice){
            
             $obr = new SendInvoiceToOBR();
             $response = $obr->cancelInvoice( $invoice ,  '# '. $invoice .' erreur sur la facture  Annulation de la facture ');

             dump( $response );
        }

        echo "Je suis en bonne et du forme";
        return 0;
    }
}
