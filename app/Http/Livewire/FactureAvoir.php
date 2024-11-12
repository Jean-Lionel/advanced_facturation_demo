<?php

namespace App\Http\Livewire;

use App\Http\Controllers\SendInvoiceToOBR;
use Livewire\Component;
use App\Models\Order;

use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Document\Security;

class FactureAvoir extends Component
{
    public $search = '';
    public $selectedFacture = null;
    public $originalFacture = null;
    public $montantAvoir = 0;
    public $motifAvoir = '';
    public $products = [];
    public $selectedProducts = [];
    public $choosedProducts = [];
    public $productsQuantities = [];
    public $productsProductsPrices = [];
    
    protected $rules = [
        'selectedFacture' => 'required',
      //  'montantAvoir' => 'required|numeric|gt:0',
        'motifAvoir' => 'required|string|min:3',
        'selectedProducts' => 'required|array|min:1',
    ];

    public function updatedSearch()
    {
  
        if (empty($this->search)) {
            $this->selectedFacture = null;
            $this->originalFacture = null;
            $this->products = [];
        }
    }

    public function updatedSelectedProducts(){
        $this->choosedProducts = collect($this->products)
        ->whereIn('id', $this->selectedProducts)->toArray();

        $this->productsQuantities = collect($this->selectedProducts)->mapWithKeys(function ($product, $key) {
            return [$product => $this->choosedProducts[$key]['quantite']];
        });
        $this->productsProductsPrices = collect($this->selectedProducts)->mapWithKeys(function ($product, $key) {
            return [$product => $this->choosedProducts[$key]['price']];
        });

       // dd($this->productsQuantities , $this->productsProductsPrices);

    }

    public function selectFacture($factureId)
    {
        $this->selectedFacture = $factureId;
        $this->originalFacture = Order::findOrFail($factureId);
       // $this->products = json_decode($this->originalFacture->products, true);
        $this->products = $this->originalFacture->products ;// json_decode(, true);
    }

    public function createAvoir()
    {

        $this->validate();
        try {
            DB::beginTransaction();
            // Créer la facture d'avoir         
            $avoir = new Order();
            $taux_tva = calculerTauxTVA($this->originalFacture->amount_tax, $this->originalFacture->tax);
        
            $b = $this->getSelectedProducts($taux_tva) ;// serialize();
            dd($b); 
            $avoir->amount_tax = -$this->montantAvoir;
            $avoir->invoice_type = 'FA'; // Facture d'Avoir
            
            if(!is_numeric( $taux_tva )){
                throw new \Exception($taux_tva);
            }
            // $avoir->amount_tax = -($this->montantAvoir * $taux_tva / 100);
            $avoir->tax = -($this->montantAvoir * $taux_tva / 100);
            $avoir->amount =  $avoir->amount_tax + $avoir->tax ;
            $avoir->total_quantity = $this->calculateTotalQuantity();
            $avoir->total_sacs = $this->calculateTotalSacs();
            // amount_tax calcule du Nouveau TVA 
            $avoir->type_paiement = $this->originalFacture->type_paiement;
            $avoir->type_facture = $this->originalFacture->type_facture;
          
            $avoir->company = json_encode($this->originalFacture->company);
            $avoir->client =json_encode($this->originalFacture->client) ;
           // $avoir->canceled_or_connection = $this->originalFacture->invoice_signature;
            $avoir->addresse_client = $this->originalFacture->addresse_client;
            $avoir->user_id = auth()->id();
            $avoir->client_id = $this->originalFacture->client_id;
            $avoir->commissionaire_id = $this->originalFacture->commissionaire_id;
            $avoir->maison_id = $this->originalFacture->maison_id;
            $avoir->is_cancelled = false;
            $avoir->envoye_obr = false;
            $avoir->invoice_currency = $this->originalFacture->invoice_currency;
            $avoir->date_facturation = now();
          // dd($avoir);
            $avoir->save();
            $avoir->invoice_signature = SendInvoiceToOBR::getInvoinceSignature($avoir->id, $avoir->created_at);
         
            $avoir->save();
            // Mettre à jour la facture originale
         //   $this->originalFacture->is_cancelled = true;
            $this->originalFacture->save();
            DB::commit();
            session()->flash('message', 'Facture d\'avoir créée avec succès.');
            return redirect()->route('orders.show',$avoir->id);

        } catch (\Exception $e) {
          //  dd($e);
            DB::rollback();
            session()->flash('error', 'Erreur lors de la création de la facture d\'avoir: ' . $e->getMessage());
        }
    }

    private function calculateTotalQuantity()
    {
        return collect($this->selectedProducts)->sum('quantity');
    }

    private function calculateTotalSacs()
    {
        return collect($this->selectedProducts)->sum('sacs');
    }

    private function getSelectedProducts($tax = 18)
    {
      
        return collect($this->products)
            ->whereIn('id', $this->selectedProducts)
            ->map(function($product) use($tax) {
                $item_price_nvat = ( $this->productsProductsPrices[$product['id']] *  $this->productsQuantities[$product['id']]);
                $item_price_wvat = ($item_price_nvat *  $tax /  100); 
                $product['price'] = $this->productsProductsPrices[$product['id']];
                $product['quantite'] =  $this->productsQuantities[$product['id']];
                $product['item_price_nvat'] =    $item_price_nvat ;
                //$product['item_price_wvat'] = $item_price_wvat  ;
                $product['vat'] = $item_price_wvat  ;
                $product['item_total_amount'] =  $item_price_nvat +  $item_price_wvat ; // Addition
                return $product;
            })
            ->toArray();
    }

    public function render()
    {
        $factures = Order::where('is_cancelled', false)
            ->where('invoice_type', 'FN')
            ->where(function($query) {
                $query->where('invoice_signature', 'like', "%{$this->search}%")
                    ->orWhereHas('client', function($q) {
                        $q->where('name', 'like', "%{$this->search}%");
                    });
            })
            ->with('client')
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.facture-avoir', [
            'factures' => $factures
        ]);
    }
}