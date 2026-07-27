<?php

namespace App\Http\Livewire\Ventes;

use App\Http\Controllers\SendInvoiceToOBR;
use App\Models\Client;
use App\Models\Entreprise;
use App\Models\Order;
use App\Models\Proformat;
use Livewire\Component;
use DB;

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
    public $clientResults = [];
    public $errorMessage;
    public $typePaiement;
    public $invoice_currency = 'BIF';
    public $typeFacture = 'FACTURE';
    public $parClient = 0;
    public $parAssurance = 0;
    public $parClientPourcentage = 0;
    public $parAssurancePourcentage = 0;
    public $assuranceID = 0;
    public $assuranceName = '';
    public $supplement = 0;
    //public $com


    public function render()
    {
        return view('livewire.ventes.service-vente');
    }

    protected $rules = [
        'clientNumber' => 'required',
        'typePaiement' => 'required',
        'typeFacture' => 'required',
        'table_length.*' => 'required',
        'customer' => 'required',
    ];
    protected $messages = [
        'clientNumber.required' => 'Le client est obligatoire',
        'typePaiement.required' => 'Type de paiement Obligatoire',
        'typeFacture.required' => 'Type de Facture Obligatoire',
        'customer.required' => 'Le Client est Obligatoire',
        'table_length.*.required' => 'Verfier vos informations',

    ];

    public function saveValue(){
        $company = Entreprise::currentEntreprise();
        //  dd($company);
        $this->validate($this->rules);
        try{
            DB::beginTransaction();
            $products =  $this->extractCart();
            $orderData = [
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
                'supplement' => $this->supplement,
                'invoice_currency' => $this->invoice_currency,
                'company' =>  $company->toJson(),
                'par_client' => $this->parClient,
                'par_assurance' => $this->parAssurance,
                'par_client_pourcentage' => $this->parClientPourcentage,
                'par_assurance_pourcentage' => $this->parAssurancePourcentage,
                'assurance_id' => $this->assuranceID,
                'assurance_name' => $this->assuranceName,
            ];
            $order = null ;
            if($this->typeFacture == 'FACTURE'){
                $order = Order::create($orderData);
                $signature = SendInvoiceToOBR::getInvoinceSignature($order->id,$order->created_at);
                $order->invoice_signature = $signature;
                $order->save();
            }else{
                $order = Proformat::create($orderData);
            }

            DB::commit();

            return $this->typeFacture == 'FACTURE' ? redirect()->to('orders/' . $order->id) : redirect()->to('proformats/' . $order->id);

        }catch(\Exception $e){
            DB::rollBack();
            $this->errorMessage = $e->getMessage();
        }

    }

    public function toggleAssurance( $assuranceID ,  $parClient , $parAssureur , $assuranceName){

        if($this->assuranceID == $assuranceID){
            $this->assuranceID = 0;
            $this->parClientPourcentage = 0;
            $this->parAssurancePourcentage = 0;
            $this->assuranceName = '';
            return;
        }else{
            $this->assuranceID = $assuranceID;
            $this->parClientPourcentage = $parClient;
            $this->parAssurancePourcentage = $parAssureur;
            $this->assuranceName = $assuranceName;
        }
        $this->updateUI();
    }

    public function selectClient($clientId)
    {
        $this->customer = Client::with('assuranceClients.assurance')->find($clientId);

        if (!$this->customer) {
            $this->errorMessage = 'Client non trouvé';
            $this->clientResults = [];
            return;
        }

        $this->clientNumber = $this->customer->name;
        $this->clientResults = [];
        $this->errorMessage = '';
    }

    public function searchClient()
    {
        // Kept for compatibility; selection is handled via autocomplete UI like panier.
        if ($this->customer) {
            $this->errorMessage = '';
            return;
        }

        $this->errorMessage = 'Sélectionnez un client dans la liste';
    }
    public function updateUI(){
        foreach($this->prices as $key => $price ){
            if(isset($price) && is_numeric($price)  && isset($this->quantite[$key])   && is_numeric($this->quantite[$key])){
                $this->pricesHorTva[$key] = floatval($this->quantite[$key] ?? 0) * floatval($price) ;
                $this->tvas[$key] = floatval($this->pricesHorTva[$key]) *
                floatval($this->taxes[$key] ?? 0) / 100;
                $this->pricesTVAC[$key] =   floatval($this->pricesHorTva[$key]) + floatval($this->tvas[$key]);
            }
        }
        // $this->total_montant = ;
        // Prix total TVAC
        $this->total_montant = array_sum($this->pricesTVAC);


        $this->parClient = $this->total_montant * ($this->parClientPourcentage / 100);
        $this->parAssurance = $this->total_montant * ($this->parAssurancePourcentage / 100);
    }
    public function updated($v){
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
            $v = ($this->prices[$key] * $this->quantite[$key]) * ($this->taxes[$key] ?? 0  )/100;
            $prix_hors_tva =  $this->prices[$key] * $this->quantite[$key];
            $products[] = [
                'id' =>'ITEM_'. $key,
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
