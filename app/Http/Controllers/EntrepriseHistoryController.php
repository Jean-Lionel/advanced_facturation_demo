<?php

namespace App\Http\Controllers;

use App\Models\EntrepriseHistory;
use App\Http\Requests\StoreEntrepriseHistoryRequest;
use App\Http\Requests\UpdateEntrepriseHistoryRequest;

class EntrepriseHistoryController extends Controller
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
     * @param  \App\Http\Requests\StoreEntrepriseHistoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEntrepriseHistoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EntrepriseHistory  $entrepriseHistory
     * @return \Illuminate\Http\Response
     */
    public function show(EntrepriseHistory $entrepriseHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EntrepriseHistory  $entrepriseHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(EntrepriseHistory $entrepriseHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEntrepriseHistoryRequest  $request
     * @param  \App\Models\EntrepriseHistory  $entrepriseHistory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEntrepriseHistoryRequest $request, EntrepriseHistory $entrepriseHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EntrepriseHistory  $entrepriseHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntrepriseHistory $entrepriseHistory)
    {
        //
    }
}
