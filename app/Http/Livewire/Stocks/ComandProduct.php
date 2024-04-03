<?php

namespace App\Http\Livewire\Stocks;

use App\Models\Stocke;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ComandProduct extends Component
{
    public $stock;
    public $stockProducts;
    public $products_comandes = [];
    public $sesion_key = "products.command";
    public function mount($stock){
        $this->stock = Stocke::with('products', 'stockProducts')->find($stock);

    }
    public function render()
    {
        $this->stockProducts = $this->stock->stockProducts->whereNotIn('id', Session::get( $this->sesion_key));
        $this->products_comandes = $this->stock->stockProducts->whereIn('id', Session::get( $this->sesion_key));
        return view('livewire.stocks.comand-product');
    }

    public function addProduct($id){
        session()->push($this->sesion_key, $id);
    }

    public function removeProduct($id){
        $array_v = array_filter(Session::get( $this->sesion_key),function($s) use ($id){
            return $s != $id;
        } );
        session()->put($this->sesion_key,  $array_v);
    }

    public function cancel_command(){
        session()->forget($this->sesion_key);
    }

}
