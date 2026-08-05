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
use App\Models\StockControl;
use App\Models\Stocke;
use App\Models\StockerUser;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{

    public function rapport_boutique(){
       // $ventes = StockControl::all();
        return view('stocks.rapport_boutique');
    }
    public function controls(){
        return view('stocks.controls');
    }
    public function facture_search(){
        $facture_number = request()->query('facture_number');
        $search = request()->query('search');
        $start_date = request()->query('start_date');
        $end_date = request()->query('end_date');
        $orders = Order::where('is_cancelled', '=',0)
        ->where(function($query) use($facture_number, $search, $start_date, $end_date){
            if($facture_number){
                $query->where('id', '=', $facture_number);
            }
            if($search){
                $query->where('client', 'like', "%{$search}%")
                ->orWhere('products', 'like', "%{$search}%");
            }
            if($start_date and $end_date){
                $query->whereBetween('created_at', [$start_date, $end_date]);
            }
        })
        ->sortable()
        ->latest()
        ->take(20)
        ->get();
        return view('stocks.facture_search', compact('orders', 'facture_number', 'search', 'start_date', 'end_date'));
    }
    public function impression_multiple(){

        $dateDebut = request()->query('dateDebut');
        $dateFin = request()->query('dateFin');

        $orders = Order::where('is_cancelled', '=',0)
                    ->whereBetween('created_at', [$dateDebut, $dateFin])
                    ->sortable()
                    ->latest()
                    ->take(10)
                    ->get();


        return view('stocks.impression_multiple', compact('orders') );

    }

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

    public function deleteMouvementStoc($id){
        $mouvement = ObrMouvementStock::find($id);
        // SI $mouvement->item_movement_type commence par E  c entre Modifier la quantite en stock

        if(str_starts_with($mouvement->item_movement_type, 'E')){

            // rechercher le produits par Item code
            $product = Product::where('id', $mouvement->item_product_detail_id)->first();

            if($product){
                $product->quantite -= $mouvement->item_quantity;
                $product->save();
            }
        }
        if(str_starts_with($mouvement->item_movement_type, 'S')){
            $product = Product::where('id', $mouvement->item_product_detail_id)->first();
            if($product){
                $product->quantite += $mouvement->item_quantity;
                $product->save();
            }
        }
        $mouvement->delete();
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
        $start_date = request()->query('startDate') ?? Carbon::now()->format('Y-m-d');
        $end_date = request()->query('endDate') ?? Carbon::now()->addDays(1)->format('Y-m-d');
        $orders =  Order::where('is_cancelled','=','0')
                                ->where(function($query) use($start_date, $end_date){
                                if($start_date && $end_date){
                                    $query->whereDate('created_at', '>=' , $start_date)
                                        ->whereDate('created_at','<=', $end_date);
                                }else{
                                    if($start_date){
                                        $query->whereDate('created_at','=',$start_date);
                                    }
                                    if($end_date){
                                        $query->whereDate('created_at','=',$end_date);
                                    }
                                }

                            })
                            ->sortable()
                            ->latest()
                            ->get();

        return view('journals.index', [
            'orders' => $orders, //->paginate(10),
            'startDate' => $start_date,
            'endDate' => $end_date,
            'total_tva' => $orders->sum('tax'),
            'total_facture' => $orders->count(),
            'total_amount' => $orders->sum('amount'),
            'total_amount_tax' => $orders->sum('amount_tax'),
        ] );
    }
    public function fiche_stock(Request $request){
        $use_commission = filter_var(env('APP_USE_COMMISSION', false), FILTER_VALIDATE_BOOLEAN);
        $start_date = $request->query('start_date') ?? Carbon::now()->startOfMonth()->format('Y-m-d');
        $end_date = $request->query('end_date') ?? Carbon::now()->endOfMonth()->format('Y-m-d');
        $product_name = $use_commission ? $request->query('product_name') : null;

        $query = FollowProduct::whereDate('created_at', '>=' , $start_date)
                                ->whereDate('created_at','<=', $end_date)
                                ->where('action', 'VENTE');

        if($product_name){
            $query->where('details', 'like', '%' . $product_name . '%');
        }

        $follow_products = $query->latest()->get();

        $ventes = $follow_products->where('action', 'VENTE');
        $total_quantite_vendue = $ventes->sum('quantite');
        $total_pv_vendu = $ventes->sum(function ($product) {
            $article = json_decode($product->details);

            return floatval($article->price ?? 0) * floatval($product->quantite ?? 0);
        });
        $total_pa_vendu = 0;
        $total_commission_vendue = 0;
        $total_tva_vendue = 0;
        $benefice = 0;

        if($use_commission){
            $total_pa_vendu = $ventes->sum(function ($product) {
                $article = json_decode($product->details);

                return floatval($article->price_min ?? 0) * floatval($product->quantite ?? 0);
            });
            $total_commission_vendue = $ventes->sum(function ($product) {
                $article = json_decode($product->details);
                $prixAchat = floatval($article->price_min ?? 0);
                $commission = floatval($article->commission ?? 0) / 100;

                return $prixAchat * $commission * floatval($product->quantite ?? 0);
            });
            $total_tva_vendue = $ventes->sum(function ($product) {
                $article = json_decode($product->details);

                return floatval($article->price_min ?? 0) * 0.18 * floatval($product->quantite ?? 0);
            });
            $benefice = $total_pv_vendu - ($total_pa_vendu + $total_commission_vendue + $total_tva_vendue);
        }

        return view('journals.fiche_stock', compact(
            'follow_products',
            'use_commission',
            'start_date',
            'end_date',
            'product_name',
            'total_quantite_vendue',
            'total_pa_vendu',
            'total_commission_vendue',
            'total_tva_vendue',
            'total_pv_vendu',
            'benefice'
        ));
    }

    public function journal_history(){
        $products = Product::latest()->paginate(20);
        return view('journals.history', compact('products'));
    }
    public function journal_sort_history(){
        $start_date = request()->query('start_date');
        $end_date =  request()->query('end_date');
        $products = Order::
                    where(function($query) use($start_date, $end_date){
                        if($start_date && $end_date){
                            $query->whereDate('created_at', '>=' , $start_date)
                                  ->whereDate('created_at','<=', $end_date);
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
                    ->get();

        return view('journals.sort_history', compact('products' , 'start_date', 'end_date'));
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

    public function stockeAddUser(Stocke $stocke){
        $users = User::all();
        $userstockes = StockerUser::where('stock_id', $stocke->id)->get();

        return view('stocks._add_user',compact(['stocke','users','userstockes']));
    }

    public function stockeAddUserPost(Request $request, Stocke $stocke){
        // $stocke->users()->attach($request->user);
        //dd($request->all());
        //Check if user is already
        $check = StockerUser::where('user_id',$request->user_id)
                            ->where('stock_id', $request->stock_id)->first();
        if(!$check){
            StockerUser::create([
                'user_id' => $request->user_id,
                'stock_id' => $request->stock_id,
            ]);
        }

        return redirect()->route('stocke.useradd', $stocke);
    }

    public function stockeUserRemove(StockerUser $stocke) {
        $stocke->delete();
        return redirect()->route('stocke.useradd', $stocke);
    }

    public function FactureCredit(){
        $startDate = request()->query('startDate') ;
        $endDate = request()->query('endDate') ;
        $query = Order::query();

        if ($startDate && $endDate ) {
            $query->whereBetween('created_at',[$startDate,$endDate]);
        }
        $orders =  $query->where('is_cancelled','=','0')
                            ->where(function ($query) {
                                $query->whereHas('dette', function ($query) {
                                    $query->where('montant_restant', '>', 0);
                                })->orWhere(function ($query) {
                                    $query->whereIn('type_paiement', [3, '3', 'DETTE'])
                                        ->whereDoesntHave('dette');
                                });
                            })
                            ->with('dette')
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
    public function FacturePayer(Request $request, Order $order)
    {
        $dette = $order->dette;
        $montantRestant = $dette ? max(0, (float) $dette->montant_restant) : (float) $order->amount;

        if ($montantRestant <= 0) {
            $this->markOrderAsPaid($order);

            return redirect()->route('facture.credit')
                ->with('success', 'Cette facture est déjà totalement payée.');
        }

        $montantPaye = $request->has('payer_tout') ? $montantRestant : $request->montant_paye;
        $request->merge(['montant_paye' => $montantPaye]);
        $request->validate([
            'montant_paye' => 'required|numeric|min:0.01|max:' . $montantRestant,
        ]);

        DB::beginTransaction();

        try {
            $dette = PaiementDette::where('order_id', $order->id)->first();

            if (!$dette) {
                $dette = PaiementDette::create([
                    'montant' => $order->amount,
                    'montant_restant' => $order->amount,
                    'order_id' => $order->id,
                    'status' => 'NON PAYE',
                ]);
            }

            $dette->montant_restant = max(0, (float) $dette->montant_restant - (float) $montantPaye);

            if ($dette->montant_restant <= 0) {
                $dette->status = 'DEJA PAYE';
            }

            $dette->save();

            DetailPaimentDette::create([
                'paiement_dette_id' => $dette->id,
                'montant' => $montantPaye,
            ]);

            if ($dette->montant_restant <= 0) {
                $this->markOrderAsPaid($order);
            }

            DB::commit();

            return redirect()->route('facture.credit')->with('success', 'Paiement enregistré avec succès.');
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    private function markOrderAsPaid(Order $order)
    {
        if ((int) $order->type_paiement === 1) {
            return;
        }

        $oldValues = $order->getOriginal();

        if ($order->update_info) {
            $existingUpdates = json_decode($order->update_info, true);
            $existingUpdates[] = [
                'updated_at' => now(),
                'old_values' => $oldValues,
            ];
            $order->update_info = json_encode($existingUpdates);
        } else {
            $order->update_info = json_encode([
                [
                    'updated_at' => now(),
                    'old_values' => $oldValues,
                ]
            ]);
        }

        $order->type_paiement = 1;
        $order->save();
    }


}
