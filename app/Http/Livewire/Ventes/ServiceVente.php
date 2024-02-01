<?php

namespace App\Http\Livewire\Ventes;

use App\Http\Controllers\SendInvoiceToOBR;
use App\Models\Client;
use App\Models\Entreprise;
use App\Models\Order;
use Livewire\Component;

class ServiceVente extends Component
{
    public $table_length = [];
    public $description = [];
    public $quantite = [];
    public $prices = [];
    public $taxes = [];
    public $pricesHorTva = [];
    public $tvas = [];
    public $pricesTVAC = [];
    public $total_montant = 0;
    public $clientNumber;
    public $customer;
    public $errorMessage;
    public $typePaiement;
    public $typeFacture;
    public function render()
    {
        return view('livewire.ventes.service-vente');
    }
    public function saveValue(){
        $company = Entreprise::latest()->first() ?? new Entreprise();
        //  dd($company);
        $products =  $this->extractCart();
        $order = Order::create([
            'amount' => array_sum(array_values($this->pricesTVAC)),
            'total_quantity' => count($this->table_length),
            'total_sacs' => 0,
            'tax' => array_sum(array_values($this->tvas)),
            'type_paiement' => $this->typePaiement,
            'amount_tax' => array_sum(array_values($this->pricesHorTva)),
            'products'=> serialize($products),
            'client'=> $this->customer->toJson(),
            'type_facture'=> $this->typeFacture,
            'addresse_client'=> $this->customer->addresse,
            'date_facturation'=> now(),
            'is_cancelled' => 0,
            'company' =>  $company->toJson(),
        ]);
        $signature = SendInvoiceToOBR::getInvoinceSignature($order->id,$order->created_at);
        $order->invoice_signature = $signature;
        $order->save();
    }

    public function searchClient(){
        $this->customer = Client::find($this->clientNumber);
        if($this->customer == null){
            $this->errorMessage = "Customer not found";
        }else{
            $this->errorMessage = "";
        }
    }
    public function updateUI(){
        foreach($this->prices as $key => $price ){
            if(isset($price) && is_numeric($price)  && isset($this->quantite[$key])   && is_numeric($this->quantite[$key])){
                $this->pricesHorTva[$key] = floatval($this->quantite[$key]) * floatval($price) ;
                $this->tvas[$key] = floatval($this->pricesHorTva[$key]) *  floatval($this->taxes[$key] ?? 18) / 100;
                $this->pricesTVAC[$key] =   floatval($this->pricesHorTva[$key]) + floatval($this->tvas[$key]);
            }
        }
        // $this->total_montant = ;
    }
    public function updated(){
        $this->updateUI();
    }

    public function addColumn(){
        $this->table_length[] = count($this->table_length )  +1;
    }
    public function removeItem($id){
        $this->table_length= array_filter($this->table_length, function($v) use ($id) {
            return $v != $id;
        });
        $this->description= array_filter($this->description, function($v) use ($id) {
            return $v != $id;
        }, ARRAY_FILTER_USE_KEY);
        $this->quantite = array_filter($this->quantite, function($v) use ($id) {
            return $v != $id;
        }, ARRAY_FILTER_USE_KEY);
        $this->prices = array_filter($this->prices, function($v) use ($id) {
            return $v != $id;
        }, ARRAY_FILTER_USE_KEY);
        $this->taxes = array_filter($this->taxes, function($v) use ($id) {
            return $v != $id;
        }, ARRAY_FILTER_USE_KEY);

    }

    private function extractCart(){
        $products = [];
        foreach ($this->table_length as $key) {
            $v = ($this->prices[$key] * $this->quantite[$key]) * ($this->taxes[$key] ?? 18 )/100;
            $prix_hors_tva =  $this->prices[$key] * $this->quantite[$key];
            $products[] = [
                'id' => $key,
                'name' => $this->description[$key],
                'rowId' => "SERVICE_FACTURATION",
                'price' => $this->prices[$key],
                'quantite' => $this->quantite[$key],
                'nombre_sac' => 0,
                'embalage' => 0,
                'item_ct' => 0,
                'item_tl' => 0 ,
                'item_price_nvat' => $prix_hors_tva,
                'vat' => $v,
                'item_price_wvat' => ($v + $prix_hors_tva),
                'item_total_amount' => ($v + $prix_hors_tva)
            ];
        }
        return $products;
    }
}
