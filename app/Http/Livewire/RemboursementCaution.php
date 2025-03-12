<?php
namespace App\Http\Livewire;

use App\Http\Controllers\SendInvoiceToOBR;
use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class RemboursementCaution extends Component
{
    public $search = '';
    public $selectedFacture = null;
    public $originalFacture = null;
    public $montantRemboursement = 0;
    public $motifRemboursement = '';
    public $products = [];
    public $selectedProducts = [];
    public $choosedProducts = [];
    public $productsQuantities = [];
    public $productsProductsPrices = [];
    
    protected $rules = [
        'selectedFacture' => 'required',
        'motifRemboursement' => 'required|string|min:3',
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

    public function updatedSelectedProducts()
    {
        $this->choosedProducts = collect($this->products)
            ->whereIn('id', $this->selectedProducts)
            ->toArray();

        $this->productsQuantities = collect($this->selectedProducts)->mapWithKeys(function ($product, $key) {
            return [$product => $this->choosedProducts[$key]['quantite']];
        });
        
        $this->productsProductsPrices = collect($this->selectedProducts)->mapWithKeys(function ($product, $key) {
            return [$product => $this->choosedProducts[$key]['price']];
        });
    }

    public function selectFacture($factureId)
    {
        $this->selectedFacture = $factureId;
        $this->originalFacture = Order::findOrFail($factureId);
        $this->products = $this->originalFacture->products;
    }

    public function createRemboursement()
    {
        $this->validate();
        
        try {
            DB::beginTransaction();
            
            $remboursement = new Order();
            $taux_tva = calculerTauxTVA($this->originalFacture->amount_tax, $this->originalFacture->tax);
            
            $selectedProducts = $this->getSelectedProducts($taux_tva);
            $remboursement->products = serialize($selectedProducts);

            $price_hors_tva = collect($selectedProducts)->sum('item_price_nvat');
            $price_tva = collect($selectedProducts)->sum('vat');
            $total_tvac = collect($selectedProducts)->sum('item_price_wvat');

            // Vérification du montant de remboursement
            if(abs($total_tvac) > abs($this->originalFacture->amount)) {
                throw new \Exception("Le montant du remboursement ne peut pas être supérieur au montant de la caution initiale");
            }

            $remboursement->amount_tax = $price_hors_tva;
            $remboursement->invoice_type = 'RC'; // Remboursement Caution
            $remboursement->tax = $price_tva;
            $remboursement->amount = $total_tvac;
            $remboursement->total_quantity = $this->calculateTotalQuantity();
            $remboursement->total_sacs = $this->calculateTotalSacs();
            $remboursement->type_paiement = $this->originalFacture->type_paiement;
            $remboursement->type_facture = $this->originalFacture->type_facture;
            $remboursement->company = json_encode($this->originalFacture->company);
            $remboursement->client = json_encode($this->originalFacture->client);
            $remboursement->addresse_client = $this->originalFacture->addresse_client;
            $remboursement->user_id = auth()->id();
            $remboursement->client_id = $this->originalFacture->client_id;
            $remboursement->commissionaire_id = $this->originalFacture->commissionaire_id;
            $remboursement->maison_id = $this->originalFacture->maison_id;
            $remboursement->is_cancelled = false;
            $remboursement->envoye_obr = false;
            $remboursement->invoice_currency = $this->originalFacture->invoice_currency;
            $remboursement->date_facturation = now();
            $remboursement->invoice_ref = $this->originalFacture->id;
            $remboursement->cn_motif = $this->motifRemboursement;
            
            $remboursement->save();
            
            $remboursement->invoice_signature = SendInvoiceToOBR::getInvoinceSignature(
                $remboursement->id, 
                $remboursement->created_at
            );
            
            $remboursement->save();
            
            // Mise à jour du statut de la facture originale si nécessaire
            $this->originalFacture->caution_remboursee = true;
            $this->originalFacture->save();

            DB::commit();
            
            session()->flash('message', 'Remboursement de caution créé avec succès.');
            return redirect()->route('orders.show', $remboursement->id);

        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('error', 'Erreur lors de la création du remboursement: ' . $e->getMessage());
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
                $item_price_nvat = ($this->productsProductsPrices[$product['id']] * $this->productsQuantities[$product['id']]);
                $item_price_wvat = ($item_price_nvat * $tax / 100);
                
                $product['price'] = $this->productsProductsPrices[$product['id']];
                $product['quantite'] = $this->productsQuantities[$product['id']];
                $product['item_price_nvat'] = $item_price_nvat;
                $product['item_price_wvat'] = $item_price_nvat + $item_price_wvat;
                $product['vat'] = $item_price_wvat;
                $product['item_total_amount'] = $item_price_nvat + $item_price_wvat;
                
                return $product;
            })
            ->toArray();
    }

    public function render()
    {
        $factures = Order::where('is_cancelled', false)
           // ->where('invoice_type', 'RC') // Type Caution
           // ->where('caution_remboursee', false) // Pas encore remboursée
            ->where(function($query) {
                $query->where('invoice_signature', 'like', "%{$this->search}%")
                    ->orWhereHas('client', function($q) {
                        $q->where('name', 'like', "%{$this->search}%");
                    });
            })
            ->with('client')
            ->latest()
            ->take(10)
            ->get();

        return view('livewire.remboursement-caution', [
            'factures' => $factures
        ]);
    }
}