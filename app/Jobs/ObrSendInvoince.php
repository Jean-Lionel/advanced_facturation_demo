<?php

namespace App\Jobs;

use App\Http\Controllers\SendInvoiceToOBR;
use App\Models\ObrMouvementStock;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ObrSendInvoince implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Recuperer tout les donnees qui n'ont pas été envoyer du stock
        $items = ObrMouvementStock::where('is_send_to_obr', '0')->take(10)->get();

        foreach ($items as $key => $movement) {
            # code...
            $obr = new SendInvoiceToOBR();
            try {
                //code...
                $obr = $obr->addStockMovement($movement);
                $movement->is_send_to_obr = true;
                $movement->is_sent_at = now();
                $movement->save();
            } catch (\Throwable $th) {
                //throw $th;
                Log::info("the message for log");
                print_r($th);
            }

        }
    }
}
