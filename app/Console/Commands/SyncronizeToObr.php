<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncronizeToObr extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'obr:send';

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

        $items = range(0, 45);
        $progressBar = $this->output->createProgressBar(count($items));

        $progressBar->start();

        foreach ($items as $item) {
            sleep(1);
            $progressBar->advance(1);
        }

        $progressBar->finish();

        return 0;
    }
}
