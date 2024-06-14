<?php

namespace App\Http\Livewire\Location;

use App\Models\MaisonLocation;
use App\Models\PaymentLocationMensuel;
use Livewire\Component;

class NonPayeLocation extends Component
{
    public function render()
    {
        return view('livewire.location.non-paye-location');
    }
    
    
    public function nonPayes(){
        
        // touts les maisons id 
        
        // verfication d'une dans une mois donnees 
        //maisons id 
        
        // Payment dans un interval
        $idsMaisons =  PaymentLocationMensuel::get()->map->maisonlocation_id;
        
        $nonpays = MaisonLocation::with('clients')
                                ->whereHas('clients')
                                ->whereNotIn('id', $idsMaisons)
                                ->get();
    }
}
