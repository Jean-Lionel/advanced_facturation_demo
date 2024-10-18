<?php

namespace App\Console\Commands;

use App\Http\Controllers\SendInvoiceToOBR;
use Illuminate\Console\Command;

class ObrCheckConnectvty extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'obr:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verfier que le serveur EMBS est accessible';

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
        $obr = new SendInvoiceToOBR();
        dump($obr->getToken());
        return 0;
    }
}
