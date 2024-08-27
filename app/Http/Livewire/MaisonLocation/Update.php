<?php

namespace App\Http\Livewire\MaisonLocation;

use Livewire\Component;

class Update extends Component
{
    public $maisonLocation;
    public $name;
    public $description;
    public $montant;
    public $tax;

    // "" => "H17"
    // "" => null
    // "" => 100000.0
    // "" => 18.0

    public function mount($maisonLocation ){
        $this->maisonLocation = $maisonLocation;
        $this->name = $maisonLocation->name;
        $this->description = $maisonLocation->description;
        $this->montant = $maisonLocation->montant;
        $this->tax = $maisonLocation->tax;

    }
    public function render()
    {
        return view('livewire.maison-location.update');
    }

    public function savePriceClick(){
       
        $this->maisonLocation->update([
            'name' => $this->name,
            'description' => $this->description,
           'montant' => $this->montant,
            'tax' => $this->tax,
        ]);
        return redirect()->to('maison-location');
    }
}
