<?php

namespace App\Http\Livewire;

use App\Models\Banque;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CardVente extends Component
{
	public $price =20;
	public $products;

	public function mount(){
		$this->products = Cart::content();
	}
    public function render()
    {
        $banques = collect();

        if (filter_var(env('APP_USE_BANQUE', false), FILTER_VALIDATE_BOOLEAN)) {
            $banques = Banque::active()->orderBy('name')->get();
        }

        return view('livewire.card-vente', compact('banques'));
    }

    public function updateProduct($id){
    	dd($id);
    }

    public function changePrice($rowId)
    {
    	// dd($rowId);
    	//Cart::update($rowId, ['price' => $this->price]);
    	$this->products = Cart::content();
    	$this->price = "Je serai un milliardaire";
    }
}
