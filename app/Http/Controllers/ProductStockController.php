<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStockStoreRequest;
use App\Http\Requests\ProductStockUpdateRequest;
use App\Models\ProductStock;
use Illuminate\Http\Request;

class ProductStockController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productStocks = ProductStock::all();

        return view('productStock.index', compact('productStocks'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('productStock.create');
    }

    /**
     * @param \App\Http\Requests\ProductStockStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStockStoreRequest $request)
    {
        $productStock = ProductStock::create($request->validated());

        $request->session()->flash('productStock.id', $productStock->id);

        return redirect()->route('productStock.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductStock $productStock
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ProductStock $productStock)
    {
        return view('productStock.show', compact('productStock'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductStock $productStock
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ProductStock $productStock)
    {
        return view('productStock.edit', compact('productStock'));
    }

    /**
     * @param \App\Http\Requests\ProductStockUpdateRequest $request
     * @param \App\Models\ProductStock $productStock
     * @return \Illuminate\Http\Response
     */
    public function update(ProductStockUpdateRequest $request, ProductStock $productStock)
    {
        $productStock->update($request->validated());

        $request->session()->flash('productStock.id', $productStock->id);

        return redirect()->route('productStock.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductStock $productStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ProductStock $productStock)
    {
        $productStock->delete();

        return redirect()->route('productStock.index');
    }
}
