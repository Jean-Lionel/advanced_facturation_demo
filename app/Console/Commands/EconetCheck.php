<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\SendInvoiceToOBR;

class EconetCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:econet-check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Econet connection';

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
        dump($obr->getInvoice('4000003337/wsl400000333700182/20230713164905/92613'));
        //dd($obr->getToken());
        return 0;
    }
}
