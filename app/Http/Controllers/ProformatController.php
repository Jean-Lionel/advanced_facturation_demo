<?php

namespace App\Http\Controllers;

use App\Models\Proformat;
use App\Http\Requests\StoreProformatRequest;
use App\Http\Requests\UpdateProformatRequest;
use Illuminate\Support\Str;

class ProformatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proformats = Proformat::all();
        return view('proformats.index', compact('proformats'));
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
     * @param  \App\Http\Requests\StoreProformatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProformatRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proformat  $proformat
     * @return \Illuminate\Http\Response
     */
    public function show(Proformat $proformat)
    {
        $modelFacture = env('OBR_MODEL_FACTURE', 'MODEL_PROTHEME');
        $currentModelFacture = 'cart.facture_model_prothem';
        if($modelFacture){
            $currentModelFacture = 'cart.facture_' . Str::lower($modelFacture);
        }
        $order = $proformat;
        return view( $currentModelFacture ,compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proformat  $proformat
     * @return \Illuminate\Http\Response
     */
    public function edit(Proformat $proformat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProformatRequest  $request
     * @param  \App\Models\Proformat  $proformat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProformatRequest $request, Proformat $proformat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proformat  $proformat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proformat $proformat)
    {
        //
    }
}
