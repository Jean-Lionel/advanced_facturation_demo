<?php

namespace App\Http\Controllers\Hrm;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Departement::all();

        $departments = collect($departments)->sortBy('title');

        return view('hrm.param.department',compact('departments'));
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
            'title' => 'required'
        ],[
            'required' => 'Le champs du nom du departement ne doit pas etre vide'
        ]);

        if (!$validator->fails()) {
            $data = $validator->safe()->only(['title']);

            $status = Departement::create([
                "title" => $data["title"],
                "created_by" => auth()->id(),
                "created_date" => date('Y-m-d H:i:s')
            ]);

            if($status) {
                echo json_encode([
                    'success' => true,
                    'messages' => 'nouvelle departement ajouter!!',
                    'redirect' => redirect()->route('departement.index')->with('success', 'Département ajouté avec succé')
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
                'messages' => $validator->errors()->get('title')[0]
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function show(Departement $departement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function edit(Departement $departement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departement $departement)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required'
        ],[
            'required' => 'Le champs du nom du departement ne doit pas etre vide'
        ]);

        if (!$validator->fails()) {
            $data = $validator->safe()->only(['title']);

            $status = $departement->update([
                "title" => $data["title"],
            ]);

            if($status) {
                echo json_encode([
                    'success' => true,
                    'messages' => 'Departement modifié!!',
                    'redirect' => redirect()->route('departement.index')->with('success', 'Département modifié avec succé')
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
                'messages' => $validator->errors()->get('title')[0]
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departement $departement)
    {
        $departement->delete();

        return redirect()->route('departement.index')->with('success', 'Département supprimé avec succé');

    }
}
