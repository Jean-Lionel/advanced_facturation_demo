<?php

namespace App\Http\Controllers\Hrm;

use App\Http\Controllers\Controller;
use App\Models\TypeCotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeCotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeCotations = TypeCotation::all();

        return view('hrm.param.typeCotation', compact('typeCotations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "title" => "required",
            "percentage" => "required"
        ],[
            "required" => "Le champs :attribute est requis pour continuer"
        ]);

        if(!$validator->fails()) {
            $title = $validator->safe()->only(['title'])['title'];
            $percentage = $validator->safe()->only(['percentage'])['percentage'];

            $status = TypeCotation::create([
                "title" => $title,
                "percentage" => $percentage,
                "created_by" => auth()->id(),
                "created_date" => date('Y-m-d H:i:s')
            ]);

            if($status) {
                echo json_encode([
                    'success' => true,
                    'messages' => 'nouvelle type de cotation ajouté!!'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'messages' => 'Une erreur est survenue réessayer svp!!'
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'messages' => $validator->errors()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeCotation  $typeCotation
     * @return \Illuminate\Http\Response
     */
    public function show(TypeCotation $typeCotation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeCotation  $typeCotation
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeCotation $typeCotation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeCotation  $typeCotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeCotation $typeCotation)
    {
        $validator = Validator::make($request->all(),[
            "title" => "required",
            "percentage" => "required"
        ],[
            "required" => "Le champs :attribute est requis pour continuer"
        ]);

        if(!$validator->fails()) {
            $title = $validator->safe()->only(['title'])['title'];
            $percentage = $validator->safe()->only(['percentage'])['percentage'];

            $status = $typeCotation->update([
                "title" => $title,
                "percentage" => $percentage,
            ]);

            if($status) {
                echo json_encode([
                    'success' => true,
                    'messages' => 'Type de cotation modifié avec succé!!'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'messages' => 'Une erreur est survenue réessayer svp!!'
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'messages' => $validator->errors()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeCotation  $typeCotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeCotation $typeCotation)
    {
        $typeCotation->delete();

        echo json_encode([
            'success' => true,
            'messages' => 'Type de Cotation supprimé avec succé'
        ]);
    }
}
