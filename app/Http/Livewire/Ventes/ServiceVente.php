<?php

namespace App\Http\Livewire\Ventes;

use App\Http\Controllers\SendInvoiceToOBR;
use App\Models\Client;
use App\Models\Banque;
use App\Models\Entreprise;
use App\Models\FactureBrouillon;
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
    public $errorMessage;
    public $typePaiement;
    public $banqueId;
    public $invoice_currency = 'BIF';
    public $typeFacture = 'FACTURE';
    public $parClient = 0;
    public $parAssurance = 0;
    public $parClientPourcentage = 0;
    public $parAssurancePourcentage = 0;
    public $assuranceID = 0;
    public $assuranceName = '';
    public $supplement = 0;
    public $brouillonId;
    public $showPreview = false;
    public $successMessage;
    //public $com

    public function mount(){
        $brouillonId = request()->query('brouillon');
        if($brouillonId){
            $this->loadBrouillon($brouillonId);
        }
    }


    public function render()
    {
        $banques = collect();

        if (filter_var(env('APP_USE_BANQUE', false), FILTER_VALIDATE_BOOLEAN)) {
            $banques = Banque::active()->orderBy('name')->get();
        }

        return view('livewire.ventes.service-vente', compact('banques'));
    }

    protected $rules = [
        'clientNumber' => 'required',
        'typePaiement' => 'required',
        'typeFacture' => 'required',
        'table_length.*' => 'required',
        'customer' => 'required',
    ];
    protected $messages = [
        'clientNumber.required' => 'Le Numero du client est Obligatoire',
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
            $banque = null;

            if (filter_var(env('APP_USE_BANQUE', false), FILTER_VALIDATE_BOOLEAN) && $this->banqueId) {
                $banque = Banque::active()->findOrFail($this->banqueId);
            }

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

            if ($this->typeFacture == 'FACTURE') {
                $orderData['banque_id'] = $banque->id ?? null;
                $orderData['banque'] = $banque ? $banque->toJson() : null;
            }

            $order = null ;
            if($this->typeFacture == 'FACTURE'){
                $order = Order::create($orderData);
                $signature = SendInvoiceToOBR::getInvoinceSignature($order->id,$order->created_at);
                $order->invoice_signature = $signature;
                $order->save();
            }else{
                $order = Proformat::create($orderData);
            }

            if($this->brouillonId){
                FactureBrouillon::whereKey($this->brouillonId)->delete();
            }

            DB::commit();

            return $this->typeFacture == 'FACTURE' ? redirect()->to('orders/' . $order->id) : redirect()->to('proformats/' . $order->id);

        }catch(\Exception $e){
            DB::rollBack();
            $this->errorMessage = $e->getMessage();
        }

    }

    public function previewFacture(){
        $this->successMessage = null;
        $this->validate($this->rules);

        if(count($this->table_length) == 0){
            $this->errorMessage = "Ajoutez au moins une ligne à la facture";
            return;
        }
        foreach($this->table_length as $key){
            if(empty($this->description[$key]) || !is_numeric($this->quantite[$key] ?? null) || !is_numeric($this->prices[$key] ?? null)){
                $this->errorMessage = "Chaque ligne doit avoir une description, une quantité et un prix";
                return;
            }
        }

        $this->errorMessage = null;
        $this->updateUI();
        $this->showPreview = true;
    }

    public function cancelPreview(){
        $this->showPreview = false;
    }

    public function saveBrouillon(){
        $this->successMessage = null;

        if(count($this->table_length) == 0 && !$this->customer){
            $this->errorMessage = "Le brouillon est vide";
            return;
        }

        $lignes = [];
        foreach($this->table_length as $key){
            $lignes[] = [
                'description' => $this->description[$key] ?? '',
                'quantite' => $this->quantite[$key] ?? null,
                'price' => $this->prices[$key] ?? null,
                'taxe' => $this->taxes[$key] ?? 0,
            ];
        }

        $data = [
            'user_id' => auth()->id(),
            'client_id' => $this->customer->id ?? null,
            'client_name' => $this->customer->name ?? null,
            'client_number' => $this->clientNumber,
            'type_paiement' => $this->typePaiement,
            'banque_id' => $this->banqueId ?: null,
            'invoice_currency' => $this->invoice_currency,
            'type_facture' => $this->typeFacture,
            'lignes' => $lignes,
            'amount' => array_sum(array_values($this->pricesTVAC)),
            'supplement' => is_numeric($this->supplement) ? $this->supplement : 0,
            'assurance' => [
                'id' => $this->assuranceID,
                'name' => $this->assuranceName,
                'par_client_pourcentage' => $this->parClientPourcentage,
                'par_assurance_pourcentage' => $this->parAssurancePourcentage,
            ],
        ];

        $brouillon = $this->brouillonId ? FactureBrouillon::find($this->brouillonId) : null;
        if($brouillon){
            $brouillon->update($data);
        }else{
            $brouillon = FactureBrouillon::create($data);
            $this->brouillonId = $brouillon->id;
        }

        $this->errorMessage = null;
        $this->successMessage = "Brouillon #{$brouillon->id} enregistré";
    }

    public function loadBrouillon($id){
        $brouillon = FactureBrouillon::find($id);
        if(!$brouillon){
            $this->errorMessage = "Brouillon introuvable";
            return;
        }

        $this->brouillonId = $brouillon->id;
        $this->customer = $brouillon->client_id ? Client::find($brouillon->client_id) : null;
        $this->clientNumber = $brouillon->client_number;
        $this->typePaiement = $brouillon->type_paiement;
        $this->banqueId = $brouillon->banque_id;
        $this->invoice_currency = $brouillon->invoice_currency ?: 'BIF';
        $this->typeFacture = $brouillon->type_facture ?: 'FACTURE';
        $this->supplement = $brouillon->supplement;

        $this->table_length = $this->description = $this->quantite = $this->prices = $this->taxes = [];
        $this->pricesHorTva = $this->tvas = $this->pricesTVAC = [];
        foreach(($brouillon->lignes ?? []) as $index => $ligne){
            $key = $index + 1;
            $this->table_length[] = $key;
            $this->description[$key] = $ligne['description'] ?? '';
            $this->quantite[$key] = $ligne['quantite'] ?? null;
            $this->prices[$key] = $ligne['price'] ?? null;
            $this->taxes[$key] = $ligne['taxe'] ?? 0;
        }

        $assurance = $brouillon->assurance ?? [];
        $this->assuranceID = $assurance['id'] ?? 0;
        $this->assuranceName = $assurance['name'] ?? '';
        $this->parClientPourcentage = $assurance['par_client_pourcentage'] ?? 0;
        $this->parAssurancePourcentage = $assurance['par_assurance_pourcentage'] ?? 0;

        $this->updateUI();
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

    public function searchClient(){
        $clienN = $this->clientNumber;
        $this->customer = Client::where(function($query) use ($clienN){

            if(is_numeric($clienN)){
                $query->where('id', 'LIKE', "%{$clienN}%")
                ;
            }else{
                $query->where('name', 'LIKE', "%{$clienN}%")
                ->orWhere('telephone', 'LIKE', "%{$clienN}%")
                ->orWhere('addresse', 'LIKE', "%{$clienN}%")
                ;
            }
        })->first();
        if($this->customer == null){
            $this->errorMessage = "Client non trouvé";
        }else{
            $this->errorMessage = "";
        }
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
        $this->table_length[] = count($this->table_length) ? max($this->table_length) + 1 : 1;
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
