<?php

namespace App\Console\Commands;

use App\Http\Controllers\ObrDeclarationController;
use App\Http\Controllers\SyncronizeController;
use App\Models\Order;
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

        if($orderID == 'all'){
            $order_peding_ids = Order::with('obrPointer')->whereNull('envoye_obr')
            ->get()->map->id;
            $progressBar = $this->output->createProgressBar(count($order_peding_ids));
            $progressBar->start();
            foreach ($order_peding_ids as $item) {
                $this->info( 'Start ----------------------------------------------------------------');
                $obr = new ObrDeclarationController();
                $response =   $obr->sendInvoinceToObr( $item );
                $this->info($response);
                $progressBar->advance(1);
            }
            $progressBar->finish();
        }

        if(is_int($orderID)){
            // send a special command for sending ORDER
            $obr = new ObrDeclarationController();
            $response =   $obr->sendInvoinceToObr( $orderID );
            $this->info($response);
        }else{
            // syncronize all invoices  in the system  (not a single order)
            $t1 = time();
            $this->info( 'Start ----------------------------------------------------------------');
            $syncronize = new SyncronizeController();
            $syncronize->syncronizeInvoices();
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
