<?php

namespace App\Http\Controllers;

use App\Models\ProductHistory;
use App\Http\Requests\StoreProductHistoryRequest;
use App\Http\Requests\UpdateProductHistoryRequest;

class ProductHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductHistoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductHistoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductHistory  $productHistory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductHistory $productHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductHistory  $productHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductHistory $productHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductHistoryRequest  $request
     * @param  \App\Models\ProductHistory  $productHistory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductHistoryRequest $request, ProductHistory $productHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductHistory  $productHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductHistory $productHistory)
    {
        //
    }
}
