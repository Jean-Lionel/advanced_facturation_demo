<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommandeStoreRequest;
use App\Http\Requests\CommandeUpdateRequest;
use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $commandes = Commande::all();

        return view('commande.index', compact('commandes'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('commande.create');
    }

    /**
     * @param \App\Http\Requests\CommandeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommandeStoreRequest $request)
    {
        $commande = Commande::create($request->validated());

        $request->session()->flash('commande.id', $commande->id);

        return redirect()->route('commande.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Commande $commande
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Commande $commande)
    {
        return view('commande.show', compact('commande'));
    }


    public function bon_commande(){
        return view('commande.bon_commande');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Commande $commande
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Commande $commande)
    {
        return view('commande.edit', compact('commande'));
    }

    /**
     * @param \App\Http\Requests\CommandeUpdateRequest $request
     * @param \App\Models\Commande $commande
     * @return \Illuminate\Http\Response
     */
    public function update(CommandeUpdateRequest $request, Commande $commande)
    {
        $commande->update($request->validated());

        $request->session()->flash('commande.id', $commande->id);

        return redirect()->route('commande.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Commande $commande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Commande $commande)
    {
        $commande->delete();

        return redirect()->route('commande.index');
    }
}
