<?php

namespace App\Http\Controllers;

use App\Http\Requests\VersementTypeStoreRequest;
use App\Http\Requests\VersementTypeUpdateRequest;
use App\Models\VersementType;
use Illuminate\Http\Request;

class VersementTypeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $versementTypes = VersementType::all();

        return view('versementType.index', compact('versementTypes'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('versementType.create');
    }

    /**
     * @param \App\Http\Requests\VersementTypeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(VersementTypeStoreRequest $request)
    {
        $versementType = VersementType::create($request->validated());

        $request->session()->flash('versementType.id', $versementType->id);

        return redirect()->route('versementType.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\VersementType $versementType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, VersementType $versementType)
    {
        return view('versementType.show', compact('versementType'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\VersementType $versementType
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, VersementType $versementType)
    {
        return view('versementType.edit', compact('versementType'));
    }

    /**
     * @param \App\Http\Requests\VersementTypeUpdateRequest $request
     * @param \App\Models\VersementType $versementType
     * @return \Illuminate\Http\Response
     */
    public function update(VersementTypeUpdateRequest $request, VersementType $versementType)
    {
        $versementType->update($request->validated());

        $request->session()->flash('versementType.id', $versementType->id);

        return redirect()->route('versementType.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\VersementType $versementType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, VersementType $versementType)
    {
        $versementType->delete();

        return redirect()->route('versementType.index');
    }
}
