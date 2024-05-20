<?php

namespace App\Http\Controllers;

use App\Http\Requests\HrFicheStoreRequest;
use App\Http\Requests\HrFicheUpdateRequest;
use App\Models\HrFiche;
use Illuminate\Http\Request;

class HrFicheController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hrFiches = HrFiche::all();

        return view('hrFiche.index', compact('hrFiches'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('hrFiche.create');
    }

    /**
     * @param \App\Http\Requests\HrFicheStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(HrFicheStoreRequest $request)
    {
        $hrFiche = HrFiche::create($request->validated());

        $request->session()->flash('hrFiche.id', $hrFiche->id);

        return redirect()->route('hrFiche.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HrFiche $hrFiche
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, HrFiche $hrFiche)
    {
        return view('hrFiche.show', compact('hrFiche'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HrFiche $hrFiche
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, HrFiche $hrFiche)
    {
        return view('hrFiche.edit', compact('hrFiche'));
    }

    /**
     * @param \App\Http\Requests\HrFicheUpdateRequest $request
     * @param \App\Models\HrFiche $hrFiche
     * @return \Illuminate\Http\Response
     */
    public function update(HrFicheUpdateRequest $request, HrFiche $hrFiche)
    {
        $hrFiche->update($request->validated());

        $request->session()->flash('hrFiche.id', $hrFiche->id);

        return redirect()->route('hrFiche.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HrFiche $hrFiche
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, HrFiche $hrFiche)
    {
        $hrFiche->delete();

        return redirect()->route('hrFiche.index');
    }
}
