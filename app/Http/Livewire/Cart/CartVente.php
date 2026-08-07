<?php

namespace App\Http\Livewire\Cart;

use App\Models\Banque;
use Livewire\Component;

class CartVente extends Component
{
    public function render()
    {
        $banques = collect();

        if (filter_var(env('APP_USE_BANQUE', false), FILTER_VALIDATE_BOOLEAN)) {
            $banques = Banque::active()->orderBy('name')->get();
        }

        return view('livewire.cart.cart-vente', compact('banques'));
    }
}
