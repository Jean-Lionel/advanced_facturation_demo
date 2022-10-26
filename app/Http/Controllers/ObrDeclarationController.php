<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ObrDeclaration;
use App\Http\Requests\StoreObrDeclarationRequest;
use App\Http\Requests\UpdateObrDeclarationRequest;

class ObrDeclarationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = Order::all();
        return view('obr_declarations.index', [
            'orders' => $orders
        ]);
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
     * @param  \App\Http\Requests\StoreObrDeclarationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreObrDeclarationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ObrDeclaration  $obrDeclaration
     * @return \Illuminate\Http\Response
     */
    public function show(ObrDeclaration $obrDeclaration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ObrDeclaration  $obrDeclaration
     * @return \Illuminate\Http\Response
     */
    public function edit(ObrDeclaration $obrDeclaration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateObrDeclarationRequest  $request
     * @param  \App\Models\ObrDeclaration  $obrDeclaration
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateObrDeclarationRequest $request, ObrDeclaration $obrDeclaration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ObrDeclaration  $obrDeclaration
     * @return \Illuminate\Http\Response
     */
    public function destroy(ObrDeclaration $obrDeclaration)
    {
        //
    }
}
