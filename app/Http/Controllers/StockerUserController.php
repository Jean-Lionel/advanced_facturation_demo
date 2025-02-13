<?php

namespace App\Http\Controllers;

use App\Models\StockerUser;
use App\Http\Requests\StoreStockerUserRequest;
use App\Http\Requests\UpdateStockerUserRequest;

class StockerUserController extends Controller
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
     * @param  \App\Http\Requests\StoreStockerUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStockerUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StockerUser  $stockerUser
     * @return \Illuminate\Http\Response
     */
    public function show(StockerUser $stockerUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StockerUser  $stockerUser
     * @return \Illuminate\Http\Response
     */
    public function edit(StockerUser $stockerUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStockerUserRequest  $request
     * @param  \App\Models\StockerUser  $stockerUser
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStockerUserRequest $request, StockerUser $stockerUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StockerUser  $stockerUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockerUser $stockerUser)
    {
        //
    }
}
