<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmbalageStoreRequest;
use App\Http\Requests\EmbalageUpdateRequest;
use App\Models\Embalage;
use App\Models\TypeEmbalage;
use Illuminate\Http\Request;

class EmbalageController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $embalages = Embalage::all();

        return view('embalage.index', compact('embalages'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $typesEmballage = TypeEmbalage::all();
        return view('embalage.create', compact('typesEmballage') );
    }

    /**
     * @param \App\Http\Requests\EmbalageStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmbalageStoreRequest $request)
    {
        $embalage = Embalage::create($request->validated());

        $request->session()->flash('embalage.id', $embalage->id);

        return redirect()->route('embalage.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Embalage $embalage
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Embalage $embalage)
    {
        return view('embalage.show', compact('embalage'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Embalage $embalage
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Embalage $embalage)
    {
        $typesEmballage = TypeEmbalage::all();
        return view('embalage.edit', compact('embalage', 'typesEmballage'));
    }

    /**
     * @param \App\Http\Requests\EmbalageUpdateRequest $request
     * @param \App\Models\Embalage $embalage
     * @return \Illuminate\Http\Response
     */
    public function update(EmbalageUpdateRequest $request, Embalage $embalage)
    {
        $embalage->update($request->validated());

        $request->session()->flash('embalage.id', $embalage->id);

        return redirect()->route('embalage.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Embalage $embalage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Embalage $embalage)
    {
        $embalage->delete();

        return redirect()->route('embalage.index');
    }
}
