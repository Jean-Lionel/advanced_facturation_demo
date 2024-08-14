<?php

namespace App\Console\Commands;

use App\Http\Controllers\ObrDeclarationController;
use App\Http\Controllers\SyncronizeController;
use Illuminate\Console\Command;

class SyncronizeToObr extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'obr:send {orderID?}';

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
       
        $orderID = $this->argument('orderID');    
        
        if($orderID){
            // send a special command for sending ORDER 
            $obr = new ObrDeclarationController();
            $response =   $obr->sendInvoinceToObr( $orderID );
            var_dump($response);
        }else{
            // syncronize all invoices  in the system  (not a single order)
            $t1 = time();
            $this->info( 'Start ----------------------------------------------------------------');
            $syncronize = new SyncronizeController();
            $resp = $syncronize->syncronizeInvoices();
            $syncronize->syncronizeStock();
           // $this->info( $resp);
            $t2 = time();
            $this->info( 'FINSHID ------------------in : '. ($t2 - $t1) .' s ---------------------');
        }
      //  dump( $orderID);

        // $items = range(0, 45);
        // $progressBar = $this->output->createProgressBar(count($items));

        // $progressBar->start();

        // foreach ($items as $item) {
        //     sleep(1);
        //     $progressBar->advance(1);
        // }

        // $progressBar->finish();

        return 0;
    }
}
