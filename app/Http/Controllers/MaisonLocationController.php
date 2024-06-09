<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaisonLocationStoreRequest;
use App\Http\Requests\MaisonLocationUpdateRequest;
use App\Models\MaisonLocation;
use Illuminate\Http\Request;

class MaisonLocationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $maisonLocations = MaisonLocation::all();

        return view('maisonLocation.index', compact('maisonLocations'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('maisonLocation.create');
    }

    /**
     * @param \App\Http\Requests\MaisonLocationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaisonLocationStoreRequest $request)
    {
        $maisonLocation = MaisonLocation::create($request->validated());

        $request->session()->flash('maisonLocation.id', $maisonLocation->id);

        return redirect()->route('maisonLocation.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MaisonLocation $maisonLocation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, MaisonLocation $maisonLocation)
    {
        return view('maisonLocation.show', compact('maisonLocation'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MaisonLocation $maisonLocation
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, MaisonLocation $maisonLocation)
    {
        return view('maisonLocation.edit', compact('maisonLocation'));
    }

    /**
     * @param \App\Http\Requests\MaisonLocationUpdateRequest $request
     * @param \App\Models\MaisonLocation $maisonLocation
     * @return \Illuminate\Http\Response
     */
    public function update(MaisonLocationUpdateRequest $request, MaisonLocation $maisonLocation)
    {
        $maisonLocation->update($request->validated());

        $request->session()->flash('maisonLocation.id', $maisonLocation->id);

        return redirect()->route('maisonLocation.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MaisonLocation $maisonLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, MaisonLocation $maisonLocation)
    {
        $maisonLocation->delete();

        return redirect()->route('maisonLocation.index');
    }
}
