<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockControlStoreRequest;
use App\Http\Requests\StockControlUpdateRequest;
use App\Models\StockControl;
use Illuminate\Http\Request;

class StockControlController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $stockControls = StockControl::all();

        return view('stockControl.index', compact('stockControls'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('stockControl.create');
    }

    /**
     * @param \App\Http\Requests\StockControlStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StockControlStoreRequest $request)
    {
        $stockControl = StockControl::create($request->validated());

        $request->session()->flash('stockControl.id', $stockControl->id);

        return redirect()->route('stockControl.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\StockControl $stockControl
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, StockControl $stockControl)
    {
        return view('stockControl.show', compact('stockControl'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\StockControl $stockControl
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, StockControl $stockControl)
    {
        return view('stockControl.edit', compact('stockControl'));
    }

    /**
     * @param \App\Http\Requests\StockControlUpdateRequest $request
     * @param \App\Models\StockControl $stockControl
     * @return \Illuminate\Http\Response
     */
    public function update(StockControlUpdateRequest $request, StockControl $stockControl)
    {
        $stockControl->update($request->validated());

        $request->session()->flash('stockControl.id', $stockControl->id);

        return redirect()->route('stockControl.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\StockControl $stockControl
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, StockControl $stockControl)
    {
        $stockControl->delete();

        return redirect()->route('stockControl.index');
    }
}
