<?php

namespace App\Http\Controllers;

use App\Models\ObrMouvementStock;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\FollowProduct;
use App\Models\ProductDetail;
use App\Models\ProductHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
    * Display a listing of the resource.
    *'','name','price','date_expiration','quantite','category_id','unite_mesure'
    * @return \Illuminate\Http\Response
    */

    public function __construct(){
    }
    public function movement_stock($item_id){
        $mouvements = ObrMouvementStock::where('item_code',$item_id)->get();
        return view('products.movements', compact('mouvements', 'item_id'));
    }
    public function index()
    {

        // dd(Gate::allows('is-admin'));
        $this->authorize('view', Product::class);
        $search = request()->get('search');
        $category = request()->get('category');

        // AFFICHAGE DES PRODUITS DONT LE STOCK EST ASSOCIER

        $userId = auth()->id();

        $query = null;
        if(env('APP_CAN_USE_MULTI_STOCK', false)){
            $query = Product::with(['category', 'mouvements'])
            ->whereHas('productStocks', function ($query) use ($userId) {
                $query->whereIn('stock_id', function ($subQuery) use ($userId) {
                    $subQuery->select('stock_id')
                            ->from('stocker_users')
                            ->where('user_id', $userId);
                });
            })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('code_product', 'like', '%' . $search . '%')
                        ->orWhere('date_expiration', 'like', '%' . $search . '%')
                        ->orWhere('unite_mesure', 'like', '%' . $search . '%')
                        ->orWhere('marque', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('quantite', 'asc')
            ->latest() ;
        }else{
            $query = Product::with(['category' , 'mouvements'])->latest()
                        ->where(function($query) use ($search) {
                            if($search){
                                $query->where('name','like', '%'.$search.'%')
                                ->orWhere('code_product','like', '%'.$search.'%')
                                ->orWhere('date_expiration','like', '%'.$search.'%')
                                ->orWhere('unite_mesure','like', '%'.$search.'%')
                                ->orWhere('marque','like', '%'.$search.'%');
                            }

                        })
                        ->orderBy('quantite','asc')
                        ;
        }


         $products = [];
        if(  $category == 'STOCK VIDE'){
            $products = $query->where('quantite', 0)->latest()->paginate();
        }
        else if( $category == 'STOCK NON VIDE'){

            $products = $query->where('quantite', '>=', 1)->latest()->paginate();
        }
        else{
            $products =  $query->latest()->paginate();
        }

        return view("products.index", compact('products','search'));
    }

    public function bar_code(){
        $search = request()->query('search');
        $quantite = request()->query('quantite') ?? 10;
        $category = request()->query('category');
        $occurence = request()->query('occurence') ?? 1;

        $products = Product::where(function($quer) use($search){

            if($search){
                $quer->where('name','like', '%'.$search.'%')
                ->orWhere('code_product','like', '%'.$search.'%')
                ->orWhere('date_expiration','like', '%'.$search.'%')
                ->orWhere('unite_mesure','like', '%'.$search.'%')
                ->orWhere('marque','like', '%'.$search.'%');
            }

        })->latest()->take( $quantite)->get();

        return view("products.bar_code" , compact('products','search', 'quantite', 'occurence'));
    }


    public function create(Request $request)
    {

        $categories = Category::all();

        return view('products.create',compact('categories'));
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'price_max' => 'required|max:255',
            'code_product' => 'required',
            // 'date_expiration' => 'required|date',
            'category_id' => 'required',
            'unite_mesure' => 'required',
            'taux_tva' => 'required',
            'price_min' => 'required',
            'quantite' => 'numeric|min:0',
            'quantite_alert' => 'numeric|min:0',
        ]);

        Product::create($request->all());



        return back()->with('success', 'Enregistrement réussi');
    }

    public function show(Product $product)
    {
        return view('products.view', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', ['product' => $product, 'categories' => $categories]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'price_max' => 'numeric|required|min:0',
            'code_product' => 'required',
            // 'date_expiration' => 'required|date',
            'quantite' => 'numeric|min:0',
            'price_min' => 'numeric|min:0',
            'taux_tva' => 'numeric|min:0',
            'quantite_alert' => 'numeric|min:0',

        ]);
        $p = $product->toArray();
        ProductHistory::create([
            'product_id' => $product->id,
            'content' => json_encode($p)
        ]);
        $product->update($request->all());
        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return $this->index();
    }

    public function add_view(Product $product){
        $mouvements = ObrMouvementStock::getMouvouments();
        // $mouvements = unset('EN', $mouvements);
        if (isset($mouvements['SN'])) {
            unset($mouvements['SN']);
            unset($mouvements['ER']);
        }
        return view('products.add',compact('product', 'mouvements'));

    }
    public function add_quantite_stock(Request $request){

        $validator = [
            'quantite' => 'required|numeric|min:0',
            'montant' => 'required|numeric|min:0',
            'mouvement' => 'required|min:2|max:5',
            'date_mouvement' => 'required|date',
        ];
        $request->validate($validator);
        try {
            DB::beginTransaction();
            $product = Product::where('id', $request->product_id)->firstOrFail();
            if(in_array($request->mouvement, ['EN' ,'ER','EAJ', 'ET','EAU'])){
                // Verfication pour Voir que le Prix de Revient n'a pas change
                // Implementation de l'algorithme FIFO First In First Out
                // Recupere le stock actuel du produit
                $stock_id = $product->category->stock->id ?? 1;
                ProductDetail::create([
                    'user_id' => auth()->user()->id,
                    'stock_id' =>  $stock_id ,
                    'product_id' => $product->id,
                    'prix_revient' => $request->montant,
                    'quantite' => $request->quantite,
                    'quantite_restant' => $request->quantite,
                    'description' => 'NEW PRODUCT',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
                $product->price_max = $request->montant;  // Prix de revient du produit
                $product->quantite += $request->quantite;
            }
            if(in_array($request->mouvement, ['EI'])){
                // reanitialisation du stock
                $product->quantite = $request->quantite;
                $product->price_max = $request->montant; // Prix de revient du produit
            }
            if(in_array($request->mouvement, ['SN','SP','SV', 'SD',  'SC','SAJ','ST', 'SAU'])){
                $product->quantite -= $request->quantite;
                if ($product->quantite < 0) {
                    throw new \Exception("La quantité du stocke ne doit pas être inférieur à ZERO ", 1);
                }
            }
            ObrMouvementStock::saveMouvement(
                $product,
                $request->mouvement,
                $request->montant,
                $request->quantite,
                $request->description,
            );
            FollowProduct::create([
                'quantite' => $request->quantite,
                'details' => $product->toJson(),
                'action' => $request->mouvement,
                'product_id' => $product->id,
            ]);
            $product->save();
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            session()->flash("error_message", $e->getMessage());
            return back();
        }

        return  redirect('products');
    }
}
