<?php

namespace App\Http\Livewire\Rapports;

use App\Models\StockControl;
use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RapportBoutique extends Component
{
    use WithPagination;

    public $dateFrom;
    public $dateTo;
    public $selectedProduct = '';
    public $selectedCategory = '';
    public $search = '';
    public $perPage = 10;

    // Statistiques
    public $totalVentes = 0;
    public $totalQuantiteVendue = 0;
    public $nombreControles = 0;
    public $categories = [];
    public $products = [];

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->dateFrom = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->dateTo = Carbon::now()->format('Y-m-d');
        $this->categories = Category::all();
        $this->products = Product::all();
        $this->loadStatistics();
    }

    public function updatedDateFrom()
    {
        $this->loadStatistics();
        $this->resetPage();
    }

    public function updatedDateTo()
    {
        $this->loadStatistics();
        $this->resetPage();
    }

    public function updatedSelectedProduct()
    {
        $this->loadStatistics();
        $this->resetPage();
    }

    public function updatedSelectedCategory()
    {
        $this->loadStatistics();
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function loadStatistics()
    {
        $query = $this->getBaseQuery();

        $stats = $query->selectRaw('
            SUM(total) as total_ventes,
            SUM(sold_quantity) as total_quantite_vendue,
            COUNT(*) as nombre_controles
        ')->first();

        $this->totalVentes = $stats->total_ventes ?? 0;
        $this->totalQuantiteVendue = $stats->total_quantite_vendue ?? 0;
        $this->nombreControles = $stats->nombre_controles ?? 0;
    }

    private function getBaseQuery()
    {
        $query = StockControl::with(['product.category'])
            ->whereBetween('created_at', [
                $this->dateFrom . ' 00:00:00',
                $this->dateTo . ' 23:59:59'
            ]);

        if ($this->selectedProduct) {
            $query->where('product_id', $this->selectedProduct);
        }

        if ($this->selectedCategory) {
            $query->whereHas('product', function($q) {
                $q->where('category_id', $this->selectedCategory);
            });
        }

        if ($this->search) {
            $query->whereHas('product', function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('code_product', 'like', '%' . $this->search . '%');
            });
        }

        return $query;
    }

    public function exportExcel()
    {
        $ventes = $this->getBaseQuery()->get();

        // Vous devrez implémenter l'export Excel
        // avec Laravel Excel ou une autre solution
        session()->flash('success', 'Export Excel en cours de développement');
    }

    public function exportPDF()
    {
        $ventes = $this->getBaseQuery()->get();

        // Vous devrez implémenter l'export PDF
        // avec DomPDF ou une autre solution

        session()->flash('success', 'Export PDF en cours de développement');
    }

    public function resetFilters()
    {
        $this->dateFrom = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->dateTo = Carbon::now()->format('Y-m-d');
        $this->selectedProduct = '';
        $this->selectedCategory = '';
        $this->search = '';
        $this->loadStatistics();
        $this->resetPage();
    }
    public function render()
    {
        $ventes = $this->getBaseQuery()
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);
        return view('livewire.rapports.rapport-boutique', compact('ventes'));
    }
}
