<?php

namespace App\Jobs;

use App\Http\Controllers\SendInvoiceToOBR;
use App\Models\ObrMouvementStock;
use App\Models\ObrStockLog;
use Carbon\Carbon;
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
        // Recuperer les opérations de mois de 30 jours
        // Recuperer les mouvements dont les ids ne sont pas dans la table des activités en attentes

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
                if ($repo  && $repo->success) {
                    $movement->is_send_to_obr = 1;
                    $movement->is_sent_at = now();
                    $movement->save();
                }else{
                    ObrStockLog::create([
                        'movement_id' => $movement->id,
                        'success' => $repo->success,
                        'msg' => $repo->msg,
                        'result' => json_encode($repo->result) ,
                    ]);
                }
            } catch (\Throwable $th) {
                Log::channel('obr_log')->error($th->getMessage());
                break;
            }

        }
    }
}
