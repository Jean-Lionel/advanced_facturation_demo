<?php

namespace App\Http\Livewire\Location;

use App\Models\MaisonLocation;
use App\Models\PaymentLocationMensuel;
use Livewire\Component;

class NonPayeLocation extends Component
{
    private $nonpays = [];
    public $startDate;
    public $endDate;

    public function render()
    {
        $this->nonPayes();
        return view('livewire.location.non-paye-location',[
            'nonpays' => $this->nonpays,
        ]);
    }

    public function searchData(){
        $this->nonPayes();

    }

    private function nonPayes(){

        $s_date = $this->startDate;
        $e_date = $this->endDate;
        // touts les maisons id

        // verfication d'une dans une mois donnees
        //maisons id

        // Payment dans un interval
        $idsMaisons =  PaymentLocationMensuel::get()->map->maisonlocation_id;

        $this->nonpays = MaisonLocation::with('clients')
                                ->whereHas('clients')
                                ->where(function($query) use($s_date,$e_date ) {
                                    if($s_date && $e_date){
                                        $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
                                    }
                                })
                                ->whereNotIn('id', $idsMaisons)
                                ->latest()->paginate();
    }
}