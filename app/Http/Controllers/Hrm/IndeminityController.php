<?php

namespace App\Http\Controllers\Hrm;

use App\Http\Controllers\Controller;
use App\Models\Indeminity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndeminityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indeminities = Indeminity::all();

        return view('hrm.param.indemnity', compact('indeminities'));
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
            "percentage" => "required",
            "taxable" => "required",
        ], [
            "required" => "Le champs :attribute est requis pour continuer"
        ]);

        if (!$validator->fails()) {
            $title = $validator->safe()->only(['title'])['title'];
            $percentage = $validator->safe()->only(['percentage'])['percentage'];
            $taxable = $validator->safe()->only(['taxable'])['taxable'];

            $status = Indeminity::create([
                "title" => $title,
                "percentage" => $percentage,
                "taxable" => $taxable,
                "created_by" => auth()->id()
            ]);

            if ($status) {
                echo json_encode([
                    'success' => true,
                    'messages' => 'nouvelle indeminité ajouté!!',
                    'redirect' => redirect()->route('indeminity.index')->with('success', 'Indeminité ajouté avec succé')
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
     * @param  \App\Models\Indeminity  $indeminity
     * @return \Illuminate\Http\Response
     */
    public function show(Indeminity $indeminity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Indeminity  $indeminity
     * @return \Illuminate\Http\Response
     */
    public function edit(Indeminity $indeminity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Indeminity  $indeminity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Indeminity $indeminity)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required",
            "percentage" => "required",
            "taxable" => "required",
        ], [
            "required" => "Le champs :attribute est requis pour continuer"
        ]);

        if (!$validator->fails()) {
            $title = $validator->safe()->only(['title'])['title'];
            $percentage = $validator->safe()->only(['percentage'])['percentage'];
            $taxable = $validator->safe()->only(['taxable'])['taxable'];

            $status = $indeminity->update([
                "title" => $title,
                "percentage" => $percentage,
                "taxable" => $taxable,
            ]);

            if ($status) {
                echo json_encode([
                    'success' => true,
                    'messages' => 'Relation modifier avec succé!!',
                    'redirect' => redirect()->route('indeminity.index')->with('success', 'Indeminité modifié avec succé')
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
     * @param  \App\Models\Indeminity  $indeminity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Indeminity $indeminity)
    {
        $indeminity->delete();

        return redirect()->route('indeminity.index')->with('success', 'Indeminité supprimé avec succé');
    }
}
