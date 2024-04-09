<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommandeStoreRequest;
use App\Http\Requests\CommandeUpdateRequest;
use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{

    public function index(Request $request)
    {
        $commandes = Commande::all();

        return view('commande.index', compact('commandes'));
    }

    public function create(Request $request)
    {
        return view('commande.create');
    }


    public function store(CommandeStoreRequest $request)
    {
        $commande = Commande::create($request->validated());

        $request->session()->flash('commande.id', $commande->id);

        return redirect()->route('commande.index');
    }

    public function show(Request $request, Commande $commande)
    {
        return view('commande.show', compact('commande'));
    }


    public function bon_commande(){
        return view('commande.bon_commande');
    }

    public function edit(Request $request, Commande $commande)
    {
        return view('commande.edit', compact('commande'));
    }

    public function update(CommandeUpdateRequest $request, Commande $commande)
    {
        $commande->update($request->validated());

        $request->session()->flash('commande.id', $commande->id);

        return redirect()->route('commande.index');
    }

    public function destroy(Request $request, Commande $commande)
    {
        $commande->delete();

        return redirect()->route('commande.index');
    }
}
