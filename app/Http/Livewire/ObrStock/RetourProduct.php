<?php

namespace App\Http\Livewire\ObrStock;

use Livewire\Component;

class RetourProduct extends Component
{
    public $factureNumber;

    public function searchFacture(){
        dd($this->factureNumber);
    }
    public function render()
    {
        return view('livewire.obr-stock.retour-product');
    }
}
