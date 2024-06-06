<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderInteretStoreRequest;
use App\Http\Requests\OrderInteretUpdateRequest;
use App\Models\OrderInteret;
use Illuminate\Http\Request;

class OrderInteretController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orderInterets = OrderInteret::all();

        return view('orderInteret.index', compact('orderInterets'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('orderInteret.create');
    }

    /**
     * @param \App\Http\Requests\OrderInteretStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderInteretStoreRequest $request)
    {
        $orderInteret = OrderInteret::create($request->validated());

        $request->session()->flash('orderInteret.id', $orderInteret->id);

        return redirect()->route('orderInteret.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OrderInteret $orderInteret
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, OrderInteret $orderInteret)
    {
        return view('orderInteret.show', compact('orderInteret'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OrderInteret $orderInteret
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, OrderInteret $orderInteret)
    {
        return view('orderInteret.edit', compact('orderInteret'));
    }

    /**
     * @param \App\Http\Requests\OrderInteretUpdateRequest $request
     * @param \App\Models\OrderInteret $orderInteret
     * @return \Illuminate\Http\Response
     */
    public function update(OrderInteretUpdateRequest $request, OrderInteret $orderInteret)
    {
        $orderInteret->update($request->validated());

        $request->session()->flash('orderInteret.id', $orderInteret->id);

        return redirect()->route('orderInteret.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OrderInteret $orderInteret
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, OrderInteret $orderInteret)
    {
        $orderInteret->delete();

        return redirect()->route('orderInteret.index');
    }
}
