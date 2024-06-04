<?php

namespace App\Http\Controllers\Hrm;

use App\Http\Controllers\Controller;
use App\Models\TypeLeave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeLeaves = TypeLeave::all();

        return view('hrm.param.typeLeave', compact('typeLeaves'));
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
            "category" => "required",
        ],[
            "required" => "Le champs :attribute est requis pour continuer"
        ]);

        if(!$validator->fails()) {
            $category = $validator->safe()->only(['category'])['category'];

            $status = TypeLeave::create([
                "category" => $category,
                "created_by" => auth()->id(),
                "created_date" => date('Y-m-d H:i:s')
            ]);

            if($status) {
                echo json_encode([
                    'success' => true,
                    'messages' => 'nouvel type de congé ajouté!!',
                    "redirect" => redirect()->route('typeLeave.index')->with('success', 'categorie ajouter avec succé')
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
     * @param  \App\Models\TypeLeave  $typeLeave
     * @return \Illuminate\Http\Response
     */
    public function show(TypeLeave $typeLeave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeLeave  $typeLeave
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeLeave $typeLeave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeLeave  $typeLeave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeLeave $typeLeave)
    {
        $validator = Validator::make($request->all(),[
            "category" => "required",
        ],[
            "required" => "Le champs :attribute est requis pour continuer"
        ]);

        if(!$validator->fails()) {
            $category = $validator->safe()->only(['category'])['category'];

            $status = $typeLeave->update([
                "category" => $category,
            ]);

            if($status) {
                echo json_encode([
                    'success' => true,
                    'messages' => 'Type de congé modifié!!',
                    "redirect" => redirect()->route('typeLeave.index')->with('success', 'categorie modifié avec succé')
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
     * @param  \App\Models\TypeLeave  $typeLeave
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeLeave $typeLeave)
    {
        $typeLeave->delete();

        return redirect()->route('typeLeave.index')->with('success', 'Type de congé supprimé avec succé');

    }
}
