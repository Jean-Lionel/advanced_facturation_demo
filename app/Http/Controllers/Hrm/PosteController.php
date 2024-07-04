<?php

namespace App\Http\Controllers\Hrm;

use App\Http\Controllers\Controller;
use App\Models\Poste;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PosteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postes = Poste::all();
        $departments = Departement::select('department_id', 'title')->get();

        $postes = collect($postes)->sortBy('title');

        return view('hrm.param.poste', [
            "postes" => $postes,
            "departments" => $departments,
        ]);
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
            'title' => 'required',
            'department' => 'required'
        ], [
            'required' => 'Le champ :attribute est requis pour continuer'
        ]);


        if (!$validator->fails()) {
            $data = $validator->safe()->all();

            $status = Poste::create([
                "title" => $data['title'],
                "department_id" => $data['department'],
                "created_by" => auth()->id()
            ]);

            if ($status) {
                echo json_encode([
                    'success' => true,
                    'messages' => 'nouveau Poste ajouter!!',
                    "redirect" => redirect()->route('poste.index')->with('success', 'nouveau Poste ajouté avec succé')
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'messages' => ["error" => 'Une erreur est survenue réessayer svp!!']
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
     * @param  \App\Models\Poste  $poste
     * @return \Illuminate\Http\Response
     */
    public function show(Poste $poste)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poste  $poste
     * @return \Illuminate\Http\Response
     */
    public function edit(Poste $poste)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Poste  $poste
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poste $poste)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'department' => 'required'
        ], [
            'required' => 'Le champ :attribute est requis pour continuer'
        ]);

        if (!$validator->fails()) {
            $data = $validator->safe();

            $status = $poste->update([
                "title" => $data['title'],
                "department_id" => $data['department'],
            ]);

            if ($status) {
                echo json_encode([
                    'success' => true,
                    'messages' => 'Poste modifié!!',
                    "redirect" => redirect()->route('poste.index')->with('success', 'Poste modifié avec succé')
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'messages' => ["error" => 'Une erreur est survenue réessayer svp!!']
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
     * @param  \App\Models\Poste  $poste
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poste $poste)
    {
        $poste->delete();

        return redirect()->route('poste.index')->with('success', 'Poste supprimé avec succé');
    }
}
