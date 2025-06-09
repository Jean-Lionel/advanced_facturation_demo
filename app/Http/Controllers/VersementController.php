<?php

namespace App\Http\Controllers;

use App\Http\Requests\VersementStoreRequest;
use App\Http\Requests\VersementUpdateRequest;
use App\Models\Versement;
use Illuminate\Http\Request;

class VersementController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $versements = Versement::all();

        return view('versement.index', compact('versements'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('versement.create');
    }

    /**
     * @param \App\Http\Requests\VersementStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(VersementStoreRequest $request)
    {
        $versement = Versement::create($request->validated());

        $request->session()->flash('versement.id', $versement->id);

        return redirect()->route('versement.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Versement $versement
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Versement $versement)
    {
        return view('versement.show', compact('versement'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Versement $versement
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Versement $versement)
    {
        return view('versement.edit', compact('versement'));
    }

    /**
     * @param \App\Http\Requests\VersementUpdateRequest $request
     * @param \App\Models\Versement $versement
     * @return \Illuminate\Http\Response
     */
    public function update(VersementUpdateRequest $request, Versement $versement)
    {
        $versement->update($request->validated());

        $request->session()->flash('versement.id', $versement->id);

        return redirect()->route('versement.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Versement $versement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Versement $versement)
    {
        $versement->delete();

        return redirect()->route('versement.index');
    }
}
