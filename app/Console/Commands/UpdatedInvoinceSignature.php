<?php

namespace App\Console\Commands;

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
        $orders = Order::whereNull('envoye_time')->get();
        foreach ($orders as $key =>$order){
            $items = explode('/', $order->invoice_signature );
            $order->created_at = convertTimestamp($items[2]);
            $order->save();
            dump($key);
        }
        return 0;
    }
}
