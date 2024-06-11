<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientMaisonStoreRequest;
use App\Http\Requests\ClientMaisonUpdateRequest;
use App\Models\ClientMaison;
use Illuminate\Http\Request;

class ClientMaisonController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clientMaisons = ClientMaison::all();

        return view('clientMaison.index', compact('clientMaisons'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('clientMaison.create');
    }

    /**
     * @param \App\Http\Requests\ClientMaisonStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientMaisonStoreRequest $request)
    {
        $clientMaison = ClientMaison::create($request->validated());

        $request->session()->flash('clientMaison.id', $clientMaison->id);

        return redirect()->route('clientMaison.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ClientMaison $clientMaison
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ClientMaison $clientMaison)
    {
        return view('clientMaison.show', compact('clientMaison'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ClientMaison $clientMaison
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ClientMaison $clientMaison)
    {
        return view('clientMaison.edit', compact('clientMaison'));
    }

    /**
     * @param \App\Http\Requests\ClientMaisonUpdateRequest $request
     * @param \App\Models\ClientMaison $clientMaison
     * @return \Illuminate\Http\Response
     */
    public function update(ClientMaisonUpdateRequest $request, ClientMaison $clientMaison)
    {
        $clientMaison->update($request->validated());

        $request->session()->flash('clientMaison.id', $clientMaison->id);

        return redirect()->route('clientMaison.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ClientMaison $clientMaison
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ClientMaison $clientMaison)
    {
        $clientMaison->delete();

        return redirect()->route('clientMaison.index');
    }
}
