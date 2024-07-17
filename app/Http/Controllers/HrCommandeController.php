<?php

namespace App\Http\Controllers;

use App\Http\Requests\HrCommandeStoreRequest;
use App\Http\Requests\HrCommandeUpdateRequest;
use App\Models\HrCommande;
use Illuminate\Http\Request;

class HrCommandeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hrCommandes = HrCommande::all();

        return view('hrCommande.index', compact('hrCommandes'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('hrCommande.create');
    }

    /**
     * @param \App\Http\Requests\HrCommandeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(HrCommandeStoreRequest $request)
    {
        $hrCommande = HrCommande::create($request->validated());

        $request->session()->flash('hrCommande.id', $hrCommande->id);

        return redirect()->route('hrCommande.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HrCommande $hrCommande
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, HrCommande $hrCommande)
    {
        return view('hrCommande.show', compact('hrCommande'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HrCommande $hrCommande
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, HrCommande $hrCommande)
    {
        return view('hrCommande.edit', compact('hrCommande'));
    }

    /**
     * @param \App\Http\Requests\HrCommandeUpdateRequest $request
     * @param \App\Models\HrCommande $hrCommande
     * @return \Illuminate\Http\Response
     */
    public function update(HrCommandeUpdateRequest $request, HrCommande $hrCommande)
    {
        $hrCommande->update($request->validated());

        $request->session()->flash('hrCommande.id', $hrCommande->id);

        return redirect()->route('hrCommande.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HrCommande $hrCommande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, HrCommande $hrCommande)
    {
        $hrCommande->delete();

        return redirect()->route('hrCommande.index');
    }
}
