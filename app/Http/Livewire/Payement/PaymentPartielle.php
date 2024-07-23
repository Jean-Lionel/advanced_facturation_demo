<?php

namespace App\Http\Livewire\Payement;

use App\Models\PaymentLocationMensuel;
use Livewire\Component;

class PaymentPartielle extends Component
{
    public $periodeID = 1;
    public $paiementPartiel;
    public function render()
    {
        $this->loadPayment();
        return view('livewire.payement.payment-partielle');
    }

    public function loadPayment(){
       // Paiement partiell
       // Les personnes dont la somme de paiement pour un periode ne depasse pas la somme dont on doit payer une maison 
       $payment_maison  = PaymentLocationMensuel::
                        with('periode')->where('periode_paiement_id',$this->periodeID)
                        ->get()->groupBy('maisonlocation_id');
        //total_payment_mensuel 
        $paimentPariel = [];
        foreach($payment_maison as $key => $v){
           // dd($v->sum('montant'), $v[0]->total_payment_mensuel );
            if(floatval($v[0]->total_payment_mensuel) > $v->sum('montant')){
                $paimentPariel[$key] = $v;
            }
        }

        $this->paiementPartiel =  $paimentPariel;
    }

}
