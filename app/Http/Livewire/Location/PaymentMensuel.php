<?php

namespace App\Http\Livewire\Location;

use App\Http\Controllers\SendInvoiceToOBR;
use App\Models\Client;
use App\Models\Entreprise;
use App\Models\MaisonLocation;
use App\Models\Order;
use App\Models\PaymentLocationMensuel;
use Illuminate\Support\Facades\DB;
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
        $currentOrderId = 0;
        try {
            //code...
            
            DB::beginTransaction();
            // Creating Order 
             $paiementM =   PaymentLocationMensuel::create([
                'maisonlocation_id' => $this->paymentID,
                'description' => $this->description,
                'montant' => $this->montant,
                'date_paiement' => $this->payementDate,
                'user_id' => auth()->user()->id,
            ]);

            $client = new Client([
                'id' => $this->maison->ClientId,
                'name' => substr($this->maison->clientName ?? "" , 0,100),
                'addresse' => substr($this->maison->adresse ?? "" , 0,100),
                'customer_TIN' => $this->maison->customer_TIN,
                'vat_customer_payer'=> $this->maison->vatCustomerPayer,
            ]);
         //   dd( $client);
            // Montant Hors TVA 
            //creating order 
            $order = Order::create([
                'amount' => round($this->maison->priceTTC),
                'total_quantity' =>1,
                'total_sacs' => 0,
                'tax' => $this->maison->tax,
                'type_paiement' => $this->typePaiement,
                'amount_tax' => $this->maison->montant, // Motant Hors tax 
                'products'=> serialize($this->getProduct()),
                'client'=> $client->toJson() ,//  substr($this->maison->clientName ?? "" , 0,100) ,
                'addresse_client'=> substr($this->maison->adresse ?? "" , 0,100) ,// $this->maison->adresse,
                'date_facturation'=> now(),
                'is_cancelled' => 0,
                'client_id' => $this->maison->ClientId,
                'commissionaire_id' => null,
                'maison_id' => $paiementM->id,
                'company' =>  Entreprise::currentEntreprise()->toJson(),
            ]);
            $signature = SendInvoiceToOBR::getInvoinceSignature($order->id,$order->created_at);
            $order->invoice_signature = $signature;
            $order->save();
            
            $paiementM->order_id = $order->id;
            $paiementM->save();
            $currentOrderId = $order;
            
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();

            dd($th->getMessage());
        }

        return redirect()->to('orders/'.$currentOrderId->id);
    }
    
    protected function getProduct(){
        $products[] = [
            'id' => $this->maison->id,
            'name' => 'Loyer ' . $this->maison->name. ' || '   . $this->description ,
            'rowId' => "",
            'price' => $this->maison->montant,
            'price_revient' =>  $this->maison->montant,
            'quantite' => 1,
            'nombre_sac' => 0,
            'embalage' => 0,
            'item_ct' => 0,
            'item_tl' => 0 ,
            'item_price_nvat' =>  $this->maison->montant,
            'interet_unitaire' => 0,
            'interet_total' => 0,
            'vat' =>  $this->maison->tva,
            'item_price_wvat' => $this->maison->priceTTC,
            'item_total_amount' =>  $this->maison->priceTTC
        ];
        
        return $products;
    }
}