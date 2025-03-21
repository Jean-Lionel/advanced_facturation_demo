<?php

namespace App\Console\Commands;

use App\Models\Entreprise;
use App\Models\ObrPointer;
use App\Models\Order;
use Illuminate\Console\Command;

class UpdatedInvoinceSignature extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'obr:update-invoince';

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
        $orders = Order::whereNull( 'envoye_time')->get();
        ObrPointer::whereIn('order_id', $orders->map->id)->delete();
        $company = Entreprise::currentEntreprise();
        foreach ($orders as $key =>$order){
            $items = explode('/', $order->invoice_signature );
            $order->created_at = convertTimestamp($items[2]);
            // NIF
            $order->invoice_signature = remplacerPremierePartie($order->invoice_signature,   $company->tp_TIN , 0);
            // USER NAME
            $order->invoice_signature = remplacerPremierePartie($order->invoice_signature,   env('OBR_USERNAME') , 1);
            $order->company = $company->toJson(); 
            $order->save();
    
        }

        dump("FINISHED");
        return 0;
    }
}
