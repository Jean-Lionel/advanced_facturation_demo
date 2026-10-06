<?php

namespace App\Http\Livewire\Produits;

use Livewire\Component;
use App\Models\ObrMouvementStock;
use App\Models\Product;
use DB;

class Importations extends Component
{


    public $system_or_device_id;
    public $item_code;
    public $item_designation;
    public $item_quantity;
    public $item_measurement_unit;
    public $item_purchase_or_sale_price;
    public $item_purchase_or_sale_currency;
    public $item_movement_type;
    public $item_movement_invoice_ref;
    public $item_movement_description;
    public $item_movement_date;
    public $reference_dmc;
    public $rubrique_tarifaire;
    public $numero_paquet;
    public $description_paquet;
    public $products;
    public $selectedItems = [];
    public $searchItem;



    public function render()
    {
        return view('livewire.produits.importations');
    }

    public function searchProducts(){

        $this->products = Product::where('name', 'like', '%' . $this->searchItem . '%')
                            ->orWhere('description', 'like', '%' . $this->searchItem . '%')
                            ->take(10)->get();
    }

    //  "item_purchase_or_sale_price" devient "item_cost_price"
    // "item_purchase_or_sale_currency" devient "item_cost_price_currency"

    protected $rules = [
        "selectedItems.*.item_quantity" => "required",
        "selectedItems.*.item_cost_price" => "required",
        "selectedItems.*.item_cost_price_currency" => "required",
        "selectedItems.*.reference_dmc" => "required",
        "selectedItems.*.rubrique_tarifaire" => "required",
        "selectedItems.*.numero_paquet" => "required",
        "selectedItems.*.item_cost_price" => "required",
        "selectedItems.*.description_paquet" => "required",
        "selectedItems.*.nombre_par_paquet" => "required",
    ];

    public function addSelectedItem($product){
        $this->selectedItems[$product["id"]] = $product ;
    }

    public function removeSelectedItem($product){
     $this->selectedItems = array_filter($this->selectedItems, function($item) use ($product) {
        return $item['id'] !== $product;
    });
    }

    public function saveItem(){

        $this->validate($this->rules);
        try{
            DB::beginTransaction();

           

            foreach ($this->selectedItems as $key => $item) {

                $attributes = [
                    "system_or_device_id" => env('OBR_USERNAME'),
                    "item_code" => $item['product_id'],
                    "item_designation" => $item['name'],
                    "item_cost_price" => $item['item_cost_price'],
                    "item_quantity" => $item['item_quantity'],
                    "item_measurement_unit" => $item['unite_mesure'],
                    "product_name" => $item['product_name'],
                    "product_id" => $item['product_id'],
                    "item_purchase_or_sale_price" => 0,
                    "item_purchase_or_sale_currency" => 0,
                    "item_cost_price_currency" => $item['item_cost_price_currency'],
                    "item_movement_type" => "EN",
                    "item_movement_invoice_ref" => "",
                    "item_movement_description" => $item['item_movement_description'],
                    "item_movement_date" => now(),
                    "reference_dmc" => $item['reference_dmc'],
                    "rubrique_tarifaire" => $item['rubrique_tarifaire'],
                    "numero_paquet" => $item['numero_paquet'],
                    "nombre_par_paquet" => $item['nombre_par_paquet'],
                    'user_id' => auth()->user()->id,
                    "description_paquet" => $item['description_paquet'],
                    "item_product_detail_id" => $item['product_id'],
                    "is_importation" => "1",
                ];

            // AJouter le mouvement dans le stock

            ObrMouvementStock::create($attributes);
             // search Product by id
            $currentProduct = isset($item['product_id']) ? Product::find($item['product_id']) : null;
            // if no product we have to create it

            if(!$currentProduct){
                $currentProduct = $this->createProduct($item);
            }
            $currentProduct->quantite += $item['item_quantity'];
            $currentProduct->save();

            }
            DB::commit();
            return redirect()->route('mouvement_stock');
        }catch(Exception $e){
            DB::rollBack();
            throw $th;
        }



    }

  
}
