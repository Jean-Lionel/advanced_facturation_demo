<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeEmbalageStoreRequest;
use App\Http\Requests\TypeEmbalageUpdateRequest;
use App\Models\TypeEmbalage;
use Illuminate\Http\Request;

class TypeEmbalageController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $typeEmbalages = TypeEmbalage::all();

        return view('typeEmbalage.index', compact('typeEmbalages'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('typeEmbalage.create');
    }

    /**
     * @param \App\Http\Requests\TypeEmbalageStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeEmbalageStoreRequest $request)
    {
        $typeEmbalage = TypeEmbalage::create($request->validated());

        $request->session()->flash('typeEmbalage.id', $typeEmbalage->id);

        return redirect()->route('typeEmbalage.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TypeEmbalage $typeEmbalage
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, TypeEmbalage $typeEmbalage)
    {
        return view('typeEmbalage.show', compact('typeEmbalage'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TypeEmbalage $typeEmbalage
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, TypeEmbalage $typeEmbalage)
    {
        return view('typeEmbalage.edit', compact('typeEmbalage'));
    }

    /**
     * @param \App\Http\Requests\TypeEmbalageUpdateRequest $request
     * @param \App\Models\TypeEmbalage $typeEmbalage
     * @return \Illuminate\Http\Response
     */
    public function update(TypeEmbalageUpdateRequest $request, TypeEmbalage $typeEmbalage)
    {
        $typeEmbalage->update($request->validated());

        $request->session()->flash('typeEmbalage.id', $typeEmbalage->id);

        return redirect()->route('typeEmbalage.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TypeEmbalage $typeEmbalage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TypeEmbalage $typeEmbalage)
    {
        $typeEmbalage->delete();

        return redirect()->route('typeEmbalage.index');
    }
}
