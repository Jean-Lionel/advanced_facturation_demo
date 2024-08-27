<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use App\Models\DetailPaimentDette;
use App\Models\FollowProduct;
use App\Models\ObrMouvementStock;
use App\Models\Order;
use App\Models\PaiementDette;
use App\Models\Product;
use App\Models\Service;
use App\Models\Stocke;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{

    public function mouvement_stock(){
        $start_at =  request()->query('start_at');
        $end_at =  request()->query('end_at');
        $mouvement =  request()->query('mouvement');

        $mouvements = ObrMouvementStock::where(function ($query) use ($start_at, $end_at, $mouvement) {
            if($start_at and $end_at){
                $query->whereBetween('item_movement_date', [$start_at, $end_at]);
            }
            if($mouvement){
                $query->where('item_movement_type', $mouvement );
            }
        })->latest()->get();
        return view('stocks.mouvement_stock', compact('mouvements'));
    }

    public function index()
    {
        $stocks = Stocke::latest()->paginate(5);
        return view('stocks.index', compact('stocks'));
    }


    public function create()
    {

        return view('stocks.create');
        //
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:stockes|max:255'
        ]);

        Stocke::create($request->all());

        return $this->index();


    }


    public function show($stock)
    {
        // $poducts = Stocke::find($stocke)->stockProducts;

        return view('stocks.show', compact('stock'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Stocke  $stocke
    * @return \Illuminate\Http\Response
    */
    public function edit(Stocke $stocke)
    {
        return view('stocks.edit', compact('stocke'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Stocke  $stocke
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Stocke $stocke)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        $stocke->update($request->all());

        return $this->index();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Stocke  $stocke
    * @return \Illuminate\Http\Response
    */
    public function destroy(Stocke $stocke)
    {
        $stocke->delete();
        return back();
    }

    public function canceledInvoince()
    {
        // code...
        $orders = Order::where('is_cancelled','=',1)->get();
        return view('journals.canceledInvoince', compact('orders'));
    }

    public function cancelFactures($order_id){
        $order = Order::find($order_id);
        $order->is_cancelled = 1;
        // AJout des produits sur les facture
        $order->save();
        return back();
    }

    public function journal(){
        $startDate = request()->query('startDate') ?? Carbon::now()->format('Y-m-d');
        $endDate = request()->query('endDate') ?? Carbon::now()->addDays(1)->format('Y-m-d');
        $orders =  Order::where('is_cancelled','=','0')
                            ->whereBetween('created_at',[$startDate,$endDate])
                            ->sortable()
                            ->latest()
                            ->get();

        return view('journals.index', [
            'orders' => $orders, //->paginate(10),
            'startDate' => $startDate,
            'endDate' => $endDate,
            'total_tva' => $orders->sum('tax'),
            'total_facture' => $orders->count(),
            'total_amount' => $orders->sum('amount'),
            'total_amount_tax' => $orders->sum('amount_tax'),
        ] );
    }
    public function fiche_stock(){
        $follow_products = FollowProduct::latest()->get();
        return view('journals.fiche_stock', compact('follow_products'));
    }

    public function journal_history(){
        $products = Product::latest()->paginate(20);
        return view('journals.history', compact('products'));
    }
    public function journal_sort_history(){
        $products = Product::latest()->get();
        return view('journals.sort_history', compact('products'));
    }
    public function rapport(){

        $start_date = request()->query('start_date');
        $end_date =  request()->query('end_date');
        // dd($start_date, $end_date);
        $paiement_dette = DetailPaimentDette::whereDate('created_at','=',Carbon::now())->sum('montant');

        // La vente journaliere + La somme de paiment des dettes
        $venteJournaliere = Order::where('is_cancelled', '=',0)->whereDate('created_at','=',Carbon::now())->sum('amount') + $paiement_dette;
        //Historique
        $paiement_dette = DetailPaimentDette::where(function($query) use($start_date, $end_date){
            if($start_date && $end_date){
                $query->whereBetween('created_at',[$start_date, $end_date]);
            }else{
                if($start_date){
                    $query->whereDate('created_at','=',$start_date);
                }
                if($end_date){
                    $query->whereDate('created_at','=',$end_date);
                }
            }

        })->sum('montant');
        $vente_date = Order::where(function($query) use($start_date, $end_date){
            if($start_date && $end_date){
                $query->whereBetween('created_at',[$start_date, $end_date]);
            }else{
                if($start_date){
                    $query->whereDate('created_at','=',$start_date);
                }
                if($end_date){
                    $query->whereDate('created_at','=',$end_date);
                }
            }

        })
        ->where('is_cancelled', '=',0)
        ->sum('amount');
        $service_Date = Service::where(function($query) use($start_date, $end_date){
            if($start_date && $end_date){
                $query->whereBetween('created_at',[$start_date, $end_date]);
            }else{
                if($start_date){
                    $query->whereDate('created_at','=',$start_date);
                }
                if($end_date){
                    $query->whereDate('created_at','=',$end_date);
                }
            }

         })->sum('total');
        //La somme total du montant en caisse
        // Tout les factures paye en cache
        // Tout les paiement des dettes - les depenses
        $service_montant = Service::all()->sum('total');

        $paiement_dettes_total = DetailPaimentDette::all()->sum('montant');

        $montant_total = Order::where('is_cancelled','=','0')->sum('amount') - Depense::all()->sum('montant') +  $paiement_dettes_total + $service_montant;

        $data_history = DB::select("SELECT name, COUNT(`name`) as nombre_vendu , SUM(`quantite`) as quantite FROM `detail_orders` GROUP by name ORDER BY quantite DESC LIMIT 10");
        $data['product_name'] = collect($data_history)->map(function($item){
            return strlen($item->name) > 15 ? substr($item->name , 0, 15) . ' ...' :  $item->name;
        })->implode(',');
        $data['nombre_vendu'] = collect($data_history)->map->nombre_vendu->implode(',');
        $data['quantite'] = collect($data_history)->map->quantite->implode(',');
        $labels =    $data['product_name'];
        //$depenses = ;
        // dd($depenses);

        $totalDette = PaiementDette::all()->where('montant_restant','>',0)->sum('montant_restant');
        return view('journals.rapport',
        compact('venteJournaliere','end_date', 'start_date','labels','vente_date','montant_total', 'data','totalDette','service_Date'));
    }



    public function bonEntre(){

        $s_date =  request()->query('s_date');
        $e_date =  request()->query('e_date');
        $action =  request()->query('action');

        $d = new Carbon($e_date);
        $products = FollowProduct::where('action','=',$action)
        ->whereBetween('created_at',[$s_date,  $d->addDays(1)])->paginate();

        return view('products.bon_entre', compact('s_date', 'e_date','products','action'));
    }


}
