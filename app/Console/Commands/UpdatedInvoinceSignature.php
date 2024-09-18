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
        $orders = Order::all();
        ObrPointer::whereIn('order_id', $orders->map->id->toArray())->delete();
        $company = Entreprise::currentEntreprise();
        foreach ($orders as $key =>$order){
            $items = explode('/', $order->invoice_signature );
            $order->created_at = convertTimestamp($items[2]);
            $order->invoice_signature = remplacerPremierePartie($order->invoice_signature,  $company->tp_TIN);
            $order->company = $company->toJson();
            $order->save();
            dump($key);
    
        }

        dump("FINISHED");
        return 0;
    }
}
