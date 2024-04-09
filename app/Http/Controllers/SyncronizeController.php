<?php

namespace App\Http\Controllers;

use App\Models\CanceledInvoince;
use App\Models\ObrMouvementStock;
use App\Models\ObrPointer;
use App\Models\ObrStockLog;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SyncronizeController extends Controller
{

    public function obr_log(){
        $logs = ObrPointer::latest()->get();
        return view('entreprises.obr_log', compact('logs'));
    }
    //
    public function syncronize(){

        $response = 0;
        if(isInternetConnection()){
            try {
                //code...
            if(CAN_SYNCRONISE_STOCK){
               $this->syncronizeStock();
            }

            if(CAN_SYNCRONISE_INVOICE){
                $response =  $this->syncronizeInvoices();
            }
            } catch (\Throwable $th) {
                //throw $th;
                Log::channel('obr_log')->info( "ERROR => " .  $th->getMessage());
                return  $th;
            }

        }else{

            return response()->json([
                'success' => false,
                'data' => null,
            ]);
        }

        if($response == null){
            Session::put('cancel_syncronize', true);
        }
        return response()->json([
            'success' => true,
            'data' => $response,
        ]);
    }

    public function syncronizeInvoices(){
        $obr = new ObrDeclarationController();
        try{

           // $ws400000333700160
           //$
           $excludes_ids = Cache::remember('key',  60, function () {

            return ObrPointer::all()->map->order_id;
           });
           $order_peding_ids = Order::whereNull('envoye_obr')
                                        ->whereNotIn('id', $excludes_ids)
                                        ->get()->map->id;

            foreach ($order_peding_ids as $item) {
                try {
                    $response =   $obr->sendInvoinceToObr($item);
                }catch (\Exception $e) {
                 //   var_dump("Error sending request Time out request ". $e->getMessage());

                    return response()->json(
                       [
                        'data' => [
                            'message' => 'Une erreur est survenue lors de l\'envoi de la facture a OBR. Merci de reessayer ultérieurement.',
                            'ERROR MESSAGE ' => $e->getMessage(),
                            'CODE DE MESSAGE ' =>  $e->getCode(),
                            'FILE' => $e->getFile(),
                            'LIGNE' => $e->getLine()
                        ]
                       ]
                    );
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

                    if($order){
                        $order->is_cancelled = 1;
                        $order->save();
                    }

                    $current = CanceledInvoince::where('invoice_signature' ,'=', $item2->invoice_signature)->first();
                    $current->status = 1;
                    $current->save();
                    $item2->status = 1;
                    $item2->save();
                    // var_dump("======= ". $item2->invoice_signature ."======ANNULATION DES FACTURE===================");
                    // var_dump($response);
                    return $response;
                } catch (\Throwable $e) {
                    //throw $th;
                    // var_dump('ERROR MESSAGE ' . $e->getMessage());
                    // var_dump('CODE DE MESSAGE '. $e->getCode());
                    // var_dump('FILE => ' . $e->getFile());
                    // var_dump('LIGNE => ' . $e->getLine());

                    return response()->json([
                        'success' => false,
                        'data' => [
                            'message' => 'Une erreur est survenue lors de l\'envoi de la facture a OBR. Merci de reessayer ultérieurement.',
                            'ERROR MESSAGE ' => $e->getMessage(),
                            'CODE DE MESSAGE ' =>  $e->getCode(),
                            'FILE' => $e->getFile(),
                            'LIGNE' => $e->getLine()
                        ]
                    ]);
                }

            }
        }catch(\Exception $e){
            // var_dump('ERROR MESSAGE ' . $e->getMessage());
            // var_dump('CODE DE MESSAGE '. $e->getCode());
            // var_dump('FILE => ' . $e->getFile());
            // var_dump('LIGNE => ' . $e->getLine());
            //                var_dump($e->getTrace());
            return response()->json([
                'success' => false,
                'data' => [
                    'message' => 'Une erreur est survenue lors de l\'envoi de la facture a OBR. Merci de reessayer ultérieurement.',
                    'ERROR MESSAGE ' => $e->getMessage(),
                    'CODE DE MESSAGE ' =>  $e->getCode(),
                    'FILE' => $e->getFile(),
                    'LIGNE' => $e->getLine()
                ]
            ]);
        }
    }

    public function syncronizeStock(){
        $today = Carbon::now();
        $thirtyDaysAgo = $today->subDays(DAY_FOR_STOCK_DATA_SYNCRONIZE);
        $records = ObrStockLog::whereDate('created_at', '>', $thirtyDaysAgo)->get()->map->movement_id;
        $items = ObrMouvementStock::whereDate('created_at', '>', $thirtyDaysAgo)
        ->whereNotIn('id', $records)
        ->where('is_send_to_obr', '0')
        ->take(20)->get();
        // dump(ObrMouvementStock::all());

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
                    Log::channel('obr_log')->info( "SUCCESS => " . $movement->id . " " . $repo->msg);
                    ObrStockLog::create([
                        'movement_id' => $movement->id,
                        'success' => $repo->success,
                        'msg' => $repo->msg,
                        'result' => json_encode($repo->result),
                    ]);
                } else {
                    $log = ObrStockLog::create([
                        'movement_id' => $movement->id,
                        'success' => $repo->success,
                        'msg' => $repo->msg,
                        'result' => json_encode($repo->result),
                    ]);
                    Log::channel('obr_log')->error($log);
                }
            } catch (\Throwable $th) {
                Log::channel('obr_log')->error($th->getMessage());
                break;
            }
        }

    }
}
