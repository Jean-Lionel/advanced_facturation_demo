<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $orders = Order::all();
        foreach ($orders as $value) {
            $product = $value->products;
        }
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        //
    }
    
    public function show(Order $order)
    {
        $modelFacture = env('OBR_MODEL_FACTURE', 'MODEL_PROTHEME');
        $currentModelFacture = 'cart.facture_model_prothem';

        if ($modelFacture == 'MODEL_DUKORANE'){
            $currentModelFacture = 'cart.facture_model_dukorane';
        }

        if ($modelFacture == 'MODEL_NIYUBAHWE'){
            $currentModelFacture = 'cart.facture_model_niyubahwe';
        }

        if ($modelFacture == 'MODEL_EREFO_COMPANY'){
            $currentModelFacture = 'cart.facture_model_erfo';
        }
        
        if ($modelFacture == 'FACTURE_MODEL_BIT_HEALTH'){
            $currentModelFacture = 'cart.facture_model_bit_health';
        }
        

        return view( $currentModelFacture ,compact('order'));
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Order  $order
    * @return \Illuminate\Http\Response
    */
    public function edit(Order $order)
    {
        //
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Order  $order
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Order $order)
    {
        //
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Order  $order
    * @return \Illuminate\Http\Response
    */
    public function destroy(Order $order)
    {
        
        try {
            DB::beginTransaction();
            foreach ($order->details as $value) {
                $value->product->quantite += $value->quantite ;
                $value->product->save();
                $value->delete();
            }
            //$order->details->delete();
            // dd($order->dette);
            
            if($order->dette){
                
                $order->dette->delete();
            }
            
            $order->delete();
            
            DB::commit();
            
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            Session::flash('error', "Une erreur s'est produite");
        }
        
        return back();
    }
}
