<?php

namespace App\Http\Controllers;

use App\Models\Assurance;
use Illuminate\Http\Request;

class AssuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assurances = Assurance::latest()->paginate(25);
        return view('assurances.index', compact('assurances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assurances.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'addresse' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
        ]);

        Assurance::create($request->all());

        return redirect()->route('assurances.index')
            ->with('success', 'Assurance créée avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assurance = Assurance::findOrFail($id);
        return view('assurances.edit', compact('assurance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'addresse' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
        ]);

        $assurance = Assurance::findOrFail($id);
        $assurance->update($request->all());

        return redirect()->route('assurances.index')
            ->with('success', 'Assurance mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $assurance = Assurance::findOrFail($id);
        $assurance->delete();

        return redirect()->route('assurances.index')
            ->with('success', 'Assurance supprimée avec succès.');
    }
}
