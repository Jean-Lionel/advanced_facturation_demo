<?php

namespace App\Http\Controllers\Hrm;

use App\Http\Controllers\Controller;
use App\Models\TypeRetenue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeRetenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeRevenues = TypeRetenue::all();

        return view('hrm.param.typeDeduction', compact('typeRevenues'));
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
        $validator = Validator::make($request->all(), [
            "title" => "required",
        ], [
            "required" => "Le champs titre est requis pour continuer"
        ]);

        if (!$validator->fails()) {
            $title = $validator->safe()->only(['title'])['title'];

            $status = TypeRetenue::create([
                "name_retenue_type" => $title,
                "createdBy_retenue_type" => auth()->id()
            ]);

            if ($status) {
                echo json_encode([
                    'success' => true,
                    'messages' => 'nouvel type de retenue ajouté!!',
                    "redirect" => redirect()->route('typeRetenue.index')->with('success', 'type de déduction ajouté avec succé')
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
     * @param  \App\Models\TypeRetenue  $typeRetenue
     * @return \Illuminate\Http\Response
     */
    public function show(TypeRetenue $typeRetenue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeRetenue  $typeRetenue
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeRetenue $typeRetenue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeRetenue  $typeRetenue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeRetenue $typeRetenue)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required",
        ], [
            "required" => "Le champs titre est requis pour continuer"
        ]);

        if (!$validator->fails()) {
            $title = $validator->safe()->only(['title'])['title'];

            $status = $typeRetenue->update([
                "name_retenue_type" => $title,
            ]);

            if ($status) {
                echo json_encode([
                    'success' => true,
                    'messages' => 'Type de retenue modifié!!',
                    "redirect" => redirect()->route('typeRetenue.index')->with('success', 'type de déduction modifié avec succé')
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
     * @param  \App\Models\TypeRetenue  $typeRetenue
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeRetenue $typeRetenue)
    {
        $typeRetenue->delete();

        return redirect()->route('typeRetenue.index')->with('success', 'type de déduction supprimé avec succé');
    }
}
