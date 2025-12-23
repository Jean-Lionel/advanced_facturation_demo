<?php

namespace App\Http\Livewire\Produits;

use App\Models\ProductDetail;
use Livewire\Component;
use App\Http\Controllers\SendInvoiceToOBR;
use App\Models\Product;
use App\Models\ObrMouvementStock;
use DB;

class ImportationDmc extends Component
{
    public $dmc_number = "2025BIPORC7415";
    public $items = [];
    public $isLoading = false;
    public $reference_dmc = "";
    public $message = "";
    public $selectedItems = [];
    
    protected $rules = [
        "selectedItems.*.item_quantity" => "required",
        "selectedItems.*.item_cost_price" => "required",
        "selectedItems.*.item_cost_price_currency" => "required",
        "selectedItems.*.rubrique_tarifaire" => "required",
        "selectedItems.*.numero_paquet" => "required",
        "selectedItems.*.item_cost_price" => "required",
        "selectedItems.*.description_paquet" => "required",
        "selectedItems.*.nombre_par_paquet" => "required",
    ];
    
    public function render()
    {
        return view('livewire.produits.importation-dmc');
    }
    
    public function searchProduct($key){
        $this->validate([
            "selectedItems.{$key}.item_name" => "required",
        ]);
        
        // search product
        $product = Product::where('name' , 'like' , "%" . $this->selectedItems[$key]["item_name"] . "%")->first();
        
        if($product){
            $this->selectedItems = $this->selectedItems->map(function ($item, $index) use ($key, $product) {
                if ($index === $key) {
                    $item["product_name"] = $product->name;
                    $item["product_id"] = $product->id;
                }
                return $item;
            });
            
        }
        
    }

    public function removeProductName($key){
         $this->selectedItems = $this->selectedItems->map(function ($item, $index) use ($key) {
                if ($index === $key) {
                    $item["product_name"] = "";
                    $item["product_id"] = "";

                    unset($item["product_name"]);
                    unset($item["product_id"]);
                }
                return $item;
            });
    }
    
    public function searchValue(){
        $this->isLoading = true;
        $obr = new SendInvoiceToOBR();
        $response = $obr->getDmcItems($this->dmc_number);
        $this->isLoading = false;
        
        if($response->success){
            $this->message = $response->msg;
            $this->reference_dmc = $response->result->reference_dmc;
            $this->items = $response->result->items;
            
            $this->selectedItems = collect($response->result->items)->map(function($item){
                
                return [
                    "item_quantity" => $item->quantite ?? 0,
                    "item_cost_price" => "",
                    "item_cost_price_currency" => "",
                    "rubrique_tarifaire" => $item->rubrique_tarifaire ?? "",
                    "numero_paquet" => "",
                    "item_designation" => $item->description_article ?? "",
                    "description_paquet" => $item->description_packet ?? "",
                    "nombre_par_paquet" => "",
                ];
            });
            
            
        }else{
            $this->message = $response->msg;
        }
        
        
        //  dd($response , $response->result);
        
    }
    
    public function saveItem(){
        $this->validate($this->rules);
        
        try{
            DB::beginTransaction();

            foreach ($this->selectedItems as $key => $item) {
             $currentProduct = isset($item['product_id']) && $item['product_id'] != "" ? Product::find($item['product_id']) : null;

             // If Current Product 

            $currentProductDetail = ProductDetail::where('product_id', $currentProduct->id ?? 0)->first();

            if(!$currentProductDetail){
                // Create Product Detail
                ProductDetail::create([
                    'user_id' => auth()->user()->id,
                    'stock_id' => 1,
                    'product_id' => $currentProduct->id,
                    'prix_revient' => $item['item_cost_price'],
                    'quantite' => $item['item_quantity'],
                    'quantite_restant' => $item['item_quantity'],
                ]);
            }

             
            if(!$currentProduct){
                $currentProduct = $this->createProduct($item);
            }

                $attributes = [
                    "system_or_device_id" => env('OBR_USERNAME'),
                    "item_code" => $currentProduct->id,
                    "item_designation" => $item['item_designation'],
                    "item_cost_price" => $item['item_cost_price'],
                    "item_quantity" => $item['item_quantity'],
                    "item_measurement_unit" => $item['description_paquet'],
                    "item_purchase_or_sale_price" => 0,
                    "item_purchase_or_sale_currency" => 0,
                    "item_cost_price_currency" => $item['item_cost_price_currency'],
                    "item_movement_type" => "EN",
                    "item_movement_invoice_ref" => "",
                    "product_name" => $item['product_name'] ?? "",
                    "product_id" => $item['product_id'] ?? null,
                    "item_movement_description" => $item['item_movement_description'] ?? "",
                    "item_movement_date" => now(),
                    "reference_dmc" => $this->reference_dmc,
                    "rubrique_tarifaire" => $item['rubrique_tarifaire'],
                    "numero_paquet" => $item['numero_paquet'],
                    "nombre_par_paquet" => $item['nombre_par_paquet'],
                    'user_id' => auth()->user()->id,
                    "description_paquet" => $item['description_paquet'],
                    "item_product_detail_id" =>  $currentProduct->id,
                    "is_importation" => "1",
                ];

            // AJouter le mouvement dans le stock
            ObrMouvementStock::create($attributes);
             // search Product by id
            

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

    public function createProduct($item){
        $product = Product::create([
           'code_product' => 00000,
           'name' => $item['item_designation'],
           'price' => 0,
           'date_expiration' => now(),
           'quantite' => 0,
           'quantite_alert' => 20,
           'category_id' => 1,
           'unite_mesure' => $item['description_paquet'],
           'price_min' => 0,
           'price_max' => 0,
           'description' => $item['item_designation'],
           'marque' => $item['item_designation'],
           'taux_tva' => 0,
           'price_tvac' => 0
        ]);

        // Create Product Details 

        ProductDetail::create([
            'user_id' => auth()->user()->id,
            'stock_id' => 1,
            'product_id' => $product->id,
            'prix_revient' => $item['item_cost_price'],
            'quantite' => $item['item_quantity'],
            'quantite_restant' => $item['item_quantity'],
        ]);

        return $product;
    }
}