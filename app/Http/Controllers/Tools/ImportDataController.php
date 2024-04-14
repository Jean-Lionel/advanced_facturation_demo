<?php

namespace App\Http\Controllers\Tools;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductImport;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportDataController extends Controller
{
    //

    public function import(Request $request){

        $response = Excel::toCollection(new ProductImport, $request->file);
        //return $response[0];
        return [
            'html' => $this->makeTable($response[0]),
            'items' => $response[0],
        ];

    }
    public function import_data(){
        return view("tools.import_data");
    }

    public function save(Request $request){

        $response = [
            'existing' => [],
            'error' => [],
        ];
        $count = 0;
        foreach($request->items as $item){
            // check if the item name not already exists
            $error = [];
            $product = Product::where('name', '=', $item[2])->first();
            if($product){
                $error['existing'][] = $item[2];

                $response[] = $error;
                continue;
            }

            // if(!isValideNumber($item[5])

            // ){
            //     $error['error'][] = [
            //         'item' => $item,
            //         'message' => ' Les donnees sont invalide '
            //     ];
            // }

            if(count($error) == 0){

                try{
                    Product::create([
                        // 'id' => $item[0],
                        'code_product' => $item[1],
                        'name' => $item[2],
                        'marque' => $item[3],
                        'unite_mesure' => $item[4],
                        'quantite' => floatval($item[5]),
                        'quantite_alert' => floatval($item[6]),
                        'price_min' => floatval($item[7]) ,
                        'price' => floatval($item[8]) ,
                        'taux_tva' => floatval($item[9]) ,
                        'category_id' => 1,
                        'description' => $item[10],
                        'user_id' => auth()->user()->id,
                    ]);

                }catch(\Exception $e){
                    $error['error'][] = [
                        'item' => $item,
                        'message' => $e->getMessage(),
                    ];
                }
                $response[] = $error;

                $count ++;
            }else{
                $response[] = $error;
            }


        }
        return [
            'count' => $count,
            'response' => $response,
        ];
    }

    public function export_model(){

        return Excel::download(new ProductExport, date('Y_m_h')."_product_model.xlsx");
    }

    public function makeTable($dataCollection){

        $headers =  ProductExport::$headers;
        $body = '<table class="table table-responsive"> <thead> </tr>';
        foreach($headers as $key => $header){
            $body .= "<td> $header</td>";
        }
        $body .= '</tr></thead>';

        foreach($dataCollection as $itemLine){
            $body .= '<tr>';
            foreach($itemLine as $line){
                $body .= '<td>' . $line . '</td>';
            }
            $body .= '</tr>';
        }

        $body .= '</table>';

        return $body;
    }
}
