<?php

namespace App\Http\Controllers;

use App\Http\Requests\BienvenuHistoriqueStoreRequest;
use App\Http\Requests\BienvenuHistoriqueUpdateRequest;
use App\Models\BienvenuHistorique;
use Illuminate\Http\Request;

class BienvenuHistoriqueController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bienvenuHistoriques = BienvenuHistorique::all();

        return view('bienvenuHistorique.index', compact('bienvenuHistoriques'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('bienvenuHistorique.create');
    }

    /**
     * @param \App\Http\Requests\BienvenuHistoriqueStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BienvenuHistoriqueStoreRequest $request)
    {
        $bienvenuHistorique = BienvenuHistorique::create($request->validated());

        $request->session()->flash('bienvenuHistorique.id', $bienvenuHistorique->id);

        return redirect()->route('bienvenuHistorique.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BienvenuHistorique $bienvenuHistorique
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BienvenuHistorique $bienvenuHistorique)
    {
        return view('bienvenuHistorique.show', compact('bienvenuHistorique'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BienvenuHistorique $bienvenuHistorique
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, BienvenuHistorique $bienvenuHistorique)
    {
        return view('bienvenuHistorique.edit', compact('bienvenuHistorique'));
    }

    /**
     * @param \App\Http\Requests\BienvenuHistoriqueUpdateRequest $request
     * @param \App\Models\BienvenuHistorique $bienvenuHistorique
     * @return \Illuminate\Http\Response
     */
    public function update(BienvenuHistoriqueUpdateRequest $request, BienvenuHistorique $bienvenuHistorique)
    {
        $bienvenuHistorique->update($request->validated());

        $request->session()->flash('bienvenuHistorique.id', $bienvenuHistorique->id);

        return redirect()->route('bienvenuHistorique.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BienvenuHistorique $bienvenuHistorique
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BienvenuHistorique $bienvenuHistorique)
    {
        $bienvenuHistorique->delete();

        return redirect()->route('bienvenuHistorique.index');
    }
}
