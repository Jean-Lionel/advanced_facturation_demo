<?php
namespace App\Http\Livewire;

use App\Http\Controllers\SendInvoiceToOBR;
use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
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
    public $choosedFacture = "";
    public $typeFactureListe = ["FA" => "Facture d'Avoir", "RC" => "Remboursement Caution"];
    
    protected $rules = [
        'selectedFacture' => 'required',
        'choosedFacture' => 'required',
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
            $avoir->products = serialize( $b);
                      //             PVT HTVA	1 . 142 . 000,00
            $price_hors_tva = collect($b)->sum('item_price_nvat');
            // TVA	205 . 560,00
            $price_tva = collect($b)->sum('vat');
            // TOTAL TVAC
            $total_tvac = collect($b)->sum('item_price_wvat');
            // Check if the total amount abs is not greater than the total amount
            if(abs($total_tvac) >  abs($this->originalFacture->amount) ){
                throw new \Exception("Le montant de la facture d’avoir ne doit pas être supérieur au montant de la facture dont il fait objet");
            }
            $avoir->amount_tax = $price_hors_tva;
            $avoir->invoice_type = $this->choosedFacture; //'FA'; // Facture d'Avoir
            if(!is_numeric( $taux_tva )){
                throw new \Exception($taux_tva);
            }
            // $avoir->amount_tax = -($this->montantAvoir * $taux_tva / 100);
            $avoir->tax = $price_tva;
            $avoir->amount =   $total_tvac;
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
            $avoir->envoye_obr = null;
            $avoir->invoice_currency = $this->originalFacture->invoice_currency;
            $avoir->date_facturation = now();
            $avoir->invoice_ref = getInvoiceNumber($this->originalFacture->id);
            //$avoir->invoice_ref = $this->originalFacture->invoice_signature;
            $avoir->cn_motif = $this->motifAvoir;
            
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
          //dd($e);
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

    // This will be implemented when it will be mendatory
    public function updateMouvementStock(){
        // saveMouvement(Product $produit, string $mouvement, float $price,float $qte, $item_movement_description = null, $item_movement_invoice_ref = null , $is_single_retour = false);

        // $productsList = Product::whereIn('id', $this->selectedProducts)->get();
        // foreach ($productsList as $product){
        //     ObrMouvementStock::saveMouvement($product, 'ER', );
        // }
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
                $product['item_price_wvat'] = $item_price_nvat +  $item_price_wvat ;
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
            ->take(1)
            ->get();

        return view('livewire.facture-avoir', [
            'factures' => $factures
        ]);
    }
}