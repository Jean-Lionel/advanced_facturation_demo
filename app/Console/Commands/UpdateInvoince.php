<?php

namespace App\Console\Commands;

use App\Models\Client;
use App\Models\Order;
use Illuminate\Console\Command;

class UpdateInvoince extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-invoice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update invoice';

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
        $orders = Order::latest()->first();
        dump($orders->client->id);

        $client = Client::find($orders->client->id);
        dump($client);
        return 0;
    }
}
