<?php

namespace App\Http\Controllers;

use App\Http\Requests\HrChambreStoreRequest;
use App\Http\Requests\HrChambreUpdateRequest;
use App\Models\HrChambre;
use Illuminate\Http\Request;

class HrChambreController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hrChambres = HrChambre::all();

        return view('hrChambre.index', compact('hrChambres'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('hrChambre.create');
    }

    /**
     * @param \App\Http\Requests\HrChambreStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(HrChambreStoreRequest $request)
    {
        $hrChambre = HrChambre::create($request->validated());

        $request->session()->flash('hrChambre.id', $hrChambre->id);

        return redirect()->route('hrChambre.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HrChambre $hrChambre
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, HrChambre $hrChambre)
    {
        return view('hrChambre.show', compact('hrChambre'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HrChambre $hrChambre
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, HrChambre $hrChambre)
    {
        return view('hrChambre.edit', compact('hrChambre'));
    }

    /**
     * @param \App\Http\Requests\HrChambreUpdateRequest $request
     * @param \App\Models\HrChambre $hrChambre
     * @return \Illuminate\Http\Response
     */
    public function update(HrChambreUpdateRequest $request, HrChambre $hrChambre)
    {
        $hrChambre->update($request->validated());

        $request->session()->flash('hrChambre.id', $hrChambre->id);

        return redirect()->route('hrChambre.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HrChambre $hrChambre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, HrChambre $hrChambre)
    {
        $hrChambre->delete();

        return redirect()->route('hrChambre.index');
    }
}
