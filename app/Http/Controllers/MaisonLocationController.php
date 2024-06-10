<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaisonLocationStoreRequest;
use App\Http\Requests\MaisonLocationUpdateRequest;
use App\Models\MaisonLocation;
use Illuminate\Http\Request;

class MaisonLocationController extends Controller
{

    public function index(Request $request)
    {
        $maisonLocations = MaisonLocation::withCount('clients')->latest()->paginate();

      

        return view('maisonLocation.index', compact('maisonLocations'));
    }

    public function create(Request $request)
    {
        return view('maisonLocation.create');
    }

    public function store(MaisonLocationStoreRequest $request)
    {
        $maisonLocation = MaisonLocation::create($request->validated());

        $request->session()->flash('maisonLocation.id', $maisonLocation->id);

        return$this->index($request);
    }

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
