<?php

namespace App\Http\Livewire\Location;

use App\Http\Controllers\SendInvoiceToOBR;
use App\Models\Entreprise;
use App\Models\MaisonLocation;
use App\Models\Order;
use App\Models\PaymentLocationMensuel;
use Livewire\Component;

class PaymentMensuel extends Component
{
    public $houseNumber;
    public $maisonLocations;
    public $paymentID;
    public $payementDate;
    public $montant;
    public $description;
    public $maison;
    public $typePaiement;
    public $displayPayment = false;
    
    protected $rules = [
        'payementDate' => 'required|date',
        'montant' => 'required',
        'typePaiement' => 'required',
    ];
    
    public function render()
    {
        return view('livewire.location.payment-mensuel');
    }
    
    public function updatedHouseNumber(){
        if(strlen($this->houseNumber)){
            $this->maisonLocations = MaisonLocation::with('clients')
            ->whereHas('clients')
            ->where('name', 'like', '%'. $this->houseNumber .'%')
            ->orwhere('description', '%'. $this->houseNumber .'%')
            ->take(4)->get();
        }else{
            $this->maisonLocations = collect([]);
        }
    }
    
    public function payMensuel($payement_id){
        //  dd($payement_id);
        $this->displayPayment =  true;
        $this->paymentID = $payement_id;
        $this->maison =  MaisonLocation::with('clients')->find($payement_id);
    }
    
    public function savePayment(){
        $this->validate($this->rules);
        
        // Creating Order 
        PaymentLocationMensuel::create([
            'maisonlocation_id' => $this->paymentID,
            'description' => $this->description,
            'montant' => $this->montant,
            'date_paiement' => $this->payementDate,
        ]);
        
        // creating order 
        $order = Order::create([
            'amount' => round( $tax  + Cart::subtotal()),
            'total_quantity' =>1,
            'total_sacs' => 0,
            'tax' => $tax,
            'type_paiement' => $this->typePaiement,
            'amount_tax' => round(Cart::subtotal()), // Motant Hors tax 
            'products'=> "",
            'client'=> $client->toJson(),
            'addresse_client'=> $client->addresse,
            'date_facturation'=> now(),
            'is_cancelled' => 0,
            'client_id' => $request->client_id,
            'commissionaire_id' => null,
            'company' =>  Entreprise::currentEntreprise()->toJson(),
        ]);
        $signature = SendInvoiceToOBR::getInvoinceSignature($order->id,$order->created_at);
        $order->invoice_signature = $signature;
        $order->save();
        
    }
}
