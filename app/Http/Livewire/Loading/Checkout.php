<?php

namespace App\Http\Livewire\Loading;

use Livewire\Component;

class Checkout extends Component
{
    public $messageR = 0;

    public function checkout(){
        $resul = 0;
        for($i=0;$i<1000000; $i++){
            $resul ++;
        }
        $this->messageR = $resul;

    }
    public function render()
    {
        return view('livewire.loading.checkout');
    }
}
