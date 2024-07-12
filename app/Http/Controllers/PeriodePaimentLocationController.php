<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeriodePaimentLocationStoreRequest;
use App\Http\Requests\PeriodePaimentLocationUpdateRequest;
use App\Models\PeriodePaimentLocation;
use Illuminate\Http\Request;

class PeriodePaimentLocationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $periodePaimentLocations = PeriodePaimentLocation::all();

        return view('periodePaimentLocation.index', compact('periodePaimentLocations'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('periodePaimentLocation.create');
    }

    /**
     * @param \App\Http\Requests\PeriodePaimentLocationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PeriodePaimentLocationStoreRequest $request)
    {
        $periodePaimentLocation = PeriodePaimentLocation::create($request->validated());

        $request->session()->flash('periodePaimentLocation.id', $periodePaimentLocation->id);

        return redirect()->route('periodePaimentLocation.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PeriodePaimentLocation $periodePaimentLocation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PeriodePaimentLocation $periodePaimentLocation)
    {
        return view('periodePaimentLocation.show', compact('periodePaimentLocation'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PeriodePaimentLocation $periodePaimentLocation
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, PeriodePaimentLocation $periodePaimentLocation)
    {
        return view('periodePaimentLocation.edit', compact('periodePaimentLocation'));
    }

    /**
     * @param \App\Http\Requests\PeriodePaimentLocationUpdateRequest $request
     * @param \App\Models\PeriodePaimentLocation $periodePaimentLocation
     * @return \Illuminate\Http\Response
     */
    public function update(PeriodePaimentLocationUpdateRequest $request, PeriodePaimentLocation $periodePaimentLocation)
    {
        $periodePaimentLocation->update($request->validated());

        $request->session()->flash('periodePaimentLocation.id', $periodePaimentLocation->id);

        return redirect()->route('periodePaimentLocation.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PeriodePaimentLocation $periodePaimentLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PeriodePaimentLocation $periodePaimentLocation)
    {
        $periodePaimentLocation->delete();

        return redirect()->route('periodePaimentLocation.index');
    }
}
