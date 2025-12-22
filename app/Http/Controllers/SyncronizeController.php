<?php

namespace App\Http\Controllers;

use App\Models\CanceledInvoince;
use App\Models\ObrMouvementStock;
use App\Models\ObrPointer;
use App\Models\ObrStockLog;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SyncronizeController extends Controller
{
    public function __construct()
    {
        if(env('OBR_CAN_SYNCRONISE', false) == false){
            return response()->json([
                'success' => false,
                'data' => null,
            ]);
        }
    }

    public function obr_log(){
        $logs = ObrPointer::latest()->paginate(10);
        return view('entreprises.obr_log', compact('logs'));
    }
    //
    public function syncronize(){
        if(env('OBR_CAN_SYNCRONISE', false) == false){
            return response()->json([
                'success' => false,
                'data' => null,
            ]);
        }

        $response = 0;
        if(isInternetConnection()){
            try {
                //code...
            if(CAN_SYNCRONISE_STOCK && CAN_SYNCRONISE){
                $this->syncronizeStock();
            }
            if(CAN_SYNCRONISE_INVOICE ){
                $response =  $this->syncronizeInvoices();


               return  $response;
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
        if(!env('OBR_CAN_SYNCRONISE', false) ){
            return response()->json([
                'success' => false,
                'data' => null,
            ]);
        }
        $obr = new ObrDeclarationController();
        try{
           // $ws400000333700160
           // dd($excludes_ids);
            $order_peding_ids = Order::with('obrPointer')->whereNull('envoye_obr')
                                            ->get()->map->id;
            foreach ($order_peding_ids as $item) {
                try {
                    $response =   $obr->sendInvoinceToObr($item);
                }catch (\Exception $e) {

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

                    return $response;
                } catch (\Throwable $e) {

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



    public function syncronizeImportation(){

        $movements = ObrMouvementStock::where("is_importation",1 )
        ->whereNull("is_send_to_obr")
        ->latest()
        ->take(5)
        ->get();
        foreach($movements as $v){
             $obr = new SendInvoiceToOBR();
         $response = $obr->addStockMovementImporters($v->toArray());

        }
    }

    public function syncronizeStock(){

        if(!env('OBR_CAN_SYNCRONISE', false) ){
            return response()->json([
                'success' => false,
                'data' => null,
            ]);
        }
        // Faire la sycronisation des importations
        $this->syncronizeImportation();

        $today = Carbon::now();
        $thirtyDaysAgo = $today->subDays(DAY_FOR_STOCK_DATA_SYNCRONIZE);
        $records = ObrStockLog::whereDate('created_at', '>', $thirtyDaysAgo)->get()->map->movement_id;

        $items = ObrMouvementStock::whereDate('created_at', '>', $thirtyDaysAgo)
        ->whereNotIn('id', $records)
        ->where('is_send_to_obr', '0')
        ->take(20)->get();
        // dump(ObrMouvementStock::all());
        //dump('items',$thirtyDaysAgo , $items);

        foreach ($items as $key => $movement) {
            # code...
            try {
                $obr = new SendInvoiceToOBR();
                $response = null;
                // Verfier que le mouvement est un importation 
                if($movement->is_importation){
                    $response = $obr->addStockMovementImporters($movement->toArray());
                }else{
                    $response = $obr->addStockMovement($movement->toArray());
                }
                $repo = json_decode($response);
                dd( $repo );
              
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