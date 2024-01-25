<?php

namespace App\Jobs;

use App\Http\Controllers\ObrDeclarationController;
use App\Http\Controllers\SendInvoiceToOBR;
use App\Models\CanceledInvoince;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncroniseInvoice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $order_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order_id)
    {
        //
        $this->order_id = $order_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
          $obr = new ObrDeclarationController();
            try{
                $order_peding_ids = Order::whereNull('envoye_obr')
                                        ->get()->map->id;
                foreach ($order_peding_ids as $item) {
                    try {
                        $response =   $obr->sendInvoinceToObr($item);
                    }catch (\Exception $e) {
                       var_dump("Error sending request Time out request ". $e->getMessage());
                    }

                }
                $canceled_invoinces = CanceledInvoince::where('status', '=', 0)->get();
                foreach ($canceled_invoinces as $key => $item2) {
                    # code...
                    try {
                        //code...
                        $obr = new SendInvoiceToOBR();
                        $response = $obr->cancelInvoice( $item2->invoice_signature ,  $item2->motif);
                        $order = Order::where('invoice_signature' ,'=', $item2->invoice_signature)->first();
                        $order->is_cancelled = 1;
                        $order->save();
                        $item2->save();
                       $current = CanceledInvoince::where('invoice_signature' ,'=', $item2->invoice_signature)->first();
                       $current->status = 1;
                       $current->save();

                       var_dump("======= ". $item2->invoice_signature ."======ANNULATION DES FACTURE===================");
                       var_dump($response);
                    } catch (\Throwable $e) {
                        //throw $th;
                        var_dump('ERROR MESSAGE ' . $e->getMessage());
                        var_dump('CODE DE MESSAGE '. $e->getCode());
                        var_dump('FILE => ' . $e->getFile());
                        var_dump('LIGNE => ' . $e->getLine());
                    }

                }
            }catch(\Exception $e){
                var_dump('ERROR MESSAGE ' . $e->getMessage());
                var_dump('CODE DE MESSAGE '. $e->getCode());
                var_dump('FILE => ' . $e->getFile());
                var_dump('LIGNE => ' . $e->getLine());
//                var_dump($e->getTrace());
            }
    }
}
