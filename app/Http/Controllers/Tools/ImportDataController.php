<?php

namespace App\Http\Controllers\Tools;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportDataController extends Controller
{
    //

    public function import(Request $request){

        $response = Excel::toCollection(new ProductImport, $request->file);

       //return $response[0];
         return $this->makeTable($response[0]);

    }
    public function import_data(){
        return view("tools.import_data");
    }

    public function export_model(){

        return Excel::download(new ProductExport, date('Y_m_h')."_product.xlsx");
    }

    public function makeTable($dataCollection){

        $body = '<table class="table">';

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
