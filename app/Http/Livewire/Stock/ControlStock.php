<?php

namespace App\Http\Livewire\Stock;

use App\Models\Product;
use App\Models\Category;
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
            $product = Product::findOrFail($productId);
            $newQuantity = $this->quantities[$productId] ?? 0;

            $product->update(['quantite' => $newQuantity]);

            session()->flash('success', 'Stock mis à jour pour ' . $product->name);
            $this->loadProducts();
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la mise à jour du stock');
        }
    }

    public function render()
    {
        return view('livewire.stock.control-stock');
    }
}
