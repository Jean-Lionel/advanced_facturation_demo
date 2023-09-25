<?php

namespace App\Console\Commands;

use App\Http\Controllers\SendInvoiceToOBR;
use App\Models\ObrStockLog;
use Illuminate\Console\Command;

use App\Models\ObrMouvementStock;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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
        $today = Carbon::now();
        $thirtyDaysAgo = $today->subDays(30);
        $records = ObrStockLog::whereDate('created_at', '>', $thirtyDaysAgo)->get()->map->movement_id;
        $items = ObrMouvementStock::whereDate('created_at', '>', $thirtyDaysAgo)
            ->whereNotIn('id', $records)
            ->where('is_send_to_obr', '0')->take(20)->get();

        foreach ($items as $key => $movement) {
            # code...
            try {
                $obr = new SendInvoiceToOBR();
                $response = $obr->addStockMovement($movement->toArray());
                $repo = json_decode($response);
                if ($repo && $repo->success) {
                    $movement->is_send_to_obr = 1;
                    $movement->is_sent_at = now();
                    $movement->save();
<<<<<<< HEAD
                    Log::channel('obr_log')->info( "SUCCESS => " . $movement->id . " " . $repo->msg);
                     ObrStockLog::create([
                        'movement_id' => $movement->id,
                        'success' => $repo->success,
                        'msg' => $repo->msg,
                        'result' => json_encode($repo->result),
                    ]);
                } else {
                   $log = ObrStockLog::create([
=======
                } else {
                    ObrStockLog::create([
>>>>>>> 1c5fc9a52be826c20b97ec7df30365f9f23af570
                        'movement_id' => $movement->id,
                        'success' => $repo->success,
                        'msg' => $repo->msg,
                        'result' => json_encode($repo->result),
                    ]);
<<<<<<< HEAD
                    Log::channel('obr_log')->error($log);
=======
>>>>>>> 1c5fc9a52be826c20b97ec7df30365f9f23af570
                }
            } catch (\Throwable $th) {
                Log::channel('obr_log')->error($th->getMessage());
                break;
            }


            return 0;
        }
<<<<<<< HEAD
        return 0;
=======
>>>>>>> 1c5fc9a52be826c20b97ec7df30365f9f23af570
    }
}
