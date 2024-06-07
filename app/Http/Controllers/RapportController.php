<?php

namespace App\Http\Controllers;

use App\Models\DetailOrder;
use App\Models\Order;
use App\Models\OrderInteret;
use App\Models\Product;

class RapportController extends Controller
{
    //

    public function produit_brarudi(){
    

      $details = DetailOrder::with('product')
                            ->whereHas('product')
                            ->get();
      $brarudi_product = [];

      foreach ($details as $detail){

        if($detail->product->category_id == 3){
            $brarudi_product[] = $detail;
        }
      }


        return view('reports.produit_brarudi', compact(('brarudi_product')));
    }

    public function rapport_detail(){

        return view('reports.index');
    }

    public function partage_interet(){
        $interets = OrderInteret::latest()->paginate();
        return view('reports.partage', compact('interets'));
    }
}
