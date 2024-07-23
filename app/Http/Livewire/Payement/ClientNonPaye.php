<?php

namespace App\Http\Livewire\Payement;

use App\Models\MaisonLocation;
use App\Models\PaymentLocationMensuel;
use App\Models\PeriodePaimentLocation;
use Livewire\Component;

class ClientNonPaye extends Component
{

    public $curentNonPay;
    public $periodeID;
    public $periodeList ;
    public $isLoading = false;

    public function mount(){
        $this->periodeList = PeriodePaimentLocation::latest()->get();
    }
    public function render()
    {
      
        return view('livewire.payement.client-non-paye');
    }

    public function updatedPeriodeID(){
        $this->getNonPayment();
    }

    // public get historique payment 

    public function getNonPayment(){
        $this->isLoading = true;
        // get historique payment payment_location_mensuels
         $payment_maison_ids  = PaymentLocationMensuel::
         with('periode')->where('periode_paiement_id',$this->periodeID)
         ->get();
        // affichage de ceux qui on payer le motier 
        $this->curentNonPay =  MaisonLocation::with(['clients'])
            ->whereHas('clients')
            ->whereNotIn('id', $payment_maison_ids->map->maisonlocation_id)->get();

       $this->isLoading = false;
    }
}
