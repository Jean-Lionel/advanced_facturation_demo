<?php

namespace App\Http\Livewire\Stock;

use App\Models\Product;
use App\Models\Category;
use App\Models\ObrMouvementStock;
use App\Models\StockControl;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ControlStock extends Component
{
    public $search = '';
    public $selectedCategory = '';
    public $products = [];
    public $quantities = [];
    public $categories;

    public function mount()
    {
        $this->categories = Category::all();
        $this->loadProducts();
    }

    public function updatedSearch()
    {
        $this->loadProducts();
    }

    public function updatedSelectedCategory()
    {
        $this->loadProducts();
    }

    public function loadProducts()
    {
        $query = Product::with('category');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('code_product', 'like', '%' . $this->search . '%')
                  ->orWhere('marque', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }
        $query->where('quantite', '>', 0);

        $this->products = $query->orderBy('name')->take(100)->get();

        // Initialiser les quantités avec les valeurs actuelles
        foreach ($this->products as $product) {
            if (!isset($this->quantities[$product->id])) {
                $this->quantities[$product->id] = $product->quantite;
            }
        }
        }

    public function updateSingleProduct($productId)
    {
        try {
            DB::beginTransaction();
            $product = Product::findOrFail($productId);
            $newQuantity = $this->quantities[$productId] ?? 0;
            $soldQuantity = $product->quantite - $newQuantity;
            if ($soldQuantity <= 0 || $soldQuantity > $product->quantite) {
                session()->flash('error', 'Erreur : Quantité invalide');
                return;
            }
            $stockControl = StockControl::create([
                'product_id' => $product->id,
                'old_quantity' => $product->quantite,
                'new_quantity' => $newQuantity,
                'sold_quantity' => $soldQuantity,
                'price' => $product->prix_vente,
                'total' => $soldQuantity * $product->prix_vente,
                'user_id' => auth()->user()->id,
                'description' => json_encode([
                    'description' => 'Controle du ' . date('Y-m-d'),
                    'product_id' => $product->id,
                    'product_code' => $product->code_product,
                    'product_marque' => $product->marque,
                    'product_unite_mesure' => $product->unite_mesure,
                    'product_prix_vente' => $product->prix_vente,
                    'product_name' => $product->name,
                    'category_id' => $product->category_id
                ]),
            ]);
            ObrMouvementStock::saveMouvement($product, 'SN', $product->prix_vente, $soldQuantity, 'Controle du ' . date('Y-m-d'), $stockControl->id);

            $product->update(['quantite' => $newQuantity]);
            session()->flash('success', 'Stock mis à jour pour ' . $product->name);
            $this->loadProducts();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Erreur lors de la mise à jour du stock');
        }
    }

    public function render()
    {
        return view('livewire.stock.control-stock');
    }
}
