<?php

namespace App\Http\Controllers;

use App\Models\CanceledInvoince;
use App\Http\Requests\StoreCanceledInvoinceRequest;
use App\Http\Requests\UpdateCanceledInvoinceRequest;

class CanceledInvoinceController extends Controller
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
     * @param  \App\Http\Requests\StoreCanceledInvoinceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCanceledInvoinceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CanceledInvoince  $canceledInvoince
     * @return \Illuminate\Http\Response
     */
    public function show(CanceledInvoince $canceledInvoince)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CanceledInvoince  $canceledInvoince
     * @return \Illuminate\Http\Response
     */
    public function edit(CanceledInvoince $canceledInvoince)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCanceledInvoinceRequest  $request
     * @param  \App\Models\CanceledInvoince  $canceledInvoince
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCanceledInvoinceRequest $request, CanceledInvoince $canceledInvoince)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CanceledInvoince  $canceledInvoince
     * @return \Illuminate\Http\Response
     */
    public function destroy(CanceledInvoince $canceledInvoince)
    {
        //
    }
}
