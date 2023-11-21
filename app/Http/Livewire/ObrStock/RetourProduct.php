<?php

namespace App\Http\Livewire\ObrStock;

use App\Models\ObrMouvementStock;
use App\Models\Order;
use App\Models\Product;
use DB;
use Livewire\Component;

class RetourProduct extends Component
{
    public $factureNumber;
    public $order;
    public $description = [];
    public $toutProduits = [];
    public $listQuantite = [];
    public $produitsRetournes = [] ;

    public $listProducts = [];

    public function searchFacture(){
        $this->order = Order::find($this->factureNumber);
        $this->filterProducts();
    }

    private function filterProducts(){
        $this->produitsRetournes = \App\Models\RetourProduit::where('order_id', $this->order->id)->get()->map->product_id;
        $this->listProducts = $this->order->products;

    }

    public function saveQuantite($key, $item){
        try {
            # code...
            DB::beginTransaction();
            $qte = $this->listQuantite[$key] ?? 0;
            $description = $this->description[$key] ?? '';
            \App\Models\RetourProduit::create([
                'product_id' => $item['id'],
                'item_name' => $item['name'],
                'order_id' => $this->order->id,
                'quantite' => $qte,
                'description' => $description,
                'user_id' => auth()->user()->id,
            ]);
            $produit = Product::find($item['id']);
            if($this->listQuantite[$key] > $item['quantite']){
                throw new \Exception("La quantité retourné est supérieur à la quantité prise ", 1);
            }
            $produit->quantite += $qte;
            $produit->save();
            ObrMouvementStock::saveMouvement( $produit, 'ER', $item['price'], $qte, $description, $this->order->invoice_signature);
            $this->filterProducts();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            dd($e);
        }

    }
    public function render()
    {
        return view('livewire.obr-stock.retour-product');
    }
}
