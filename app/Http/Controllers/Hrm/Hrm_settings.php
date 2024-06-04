<?php

namespace App\Http\Controllers\Hrm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Hrm_settings extends Controller
{
    public function index() {
        $settings = DB::table('hrm_settings')->get();

        return view('hrm.param.settings',[
            'settings' => $settings
        ]);
    }

    public function save(Request $request,$id) {
        $status = DB::table('hrm_settings')->where([
            ['id','=',$id],
        ])->update([
            'content' => $request->content
        ]);

        if ($status) {
            echo json_encode([
                "success" => true,
                "messages" => "Valeur modifié avec succé"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "messages" => "Erreur lors de la modification,réessayer svp!!"
            ]);
        }
        
    }
}
