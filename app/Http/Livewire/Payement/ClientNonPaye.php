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

    public function mount(){
        $this->periodeList = PeriodePaimentLocation::latest()->get();
    }
    public function render()
    {
        $this->getNonPayment();
        return view('livewire.payement.client-non-paye');
    }

    // public get historique payment 

    public function getNonPayment(){
        // get historique payment payment_location_mensuels
         $payment_maison_ids  = PaymentLocationMensuel::where('periode_paiement_id',$this->periodeID)
                                  ->get()->map->maisonlocation_id;
        
        $this->curentNonPay =  MaisonLocation::with(['clients'])->whereNotIn('id', $payment_maison_ids)->get();
    }
}
