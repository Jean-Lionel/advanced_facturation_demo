<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentLocationMensuelStoreRequest;
use App\Http\Requests\PaymentLocationMensuelUpdateRequest;
use App\Models\MaisonLocation;
use App\Models\PaymentLocationMensuel;
use App\Models\PeriodePaimentLocation;
use Illuminate\Http\Request;

class PaymentLocationMensuelController extends Controller
{

    public function index(Request $request)
    {
        $paymentLocationMensuels = PaymentLocationMensuel::all();
        return view('paymentLocationMensuel.index', compact('paymentLocationMensuels'));
    }

    public function payer(Request $request, MaisonLocation $maisonLocation, PeriodePaimentLocation $periode)
    {
        $returnTo = $request->query('return', 'payment-location-mensuel');

        return view('paymentLocationMensuel.payer', compact('maisonLocation', 'periode', 'returnTo'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('paymentLocationMensuel.create');
    }

    /**
     * @param \App\Http\Requests\PaymentLocationMensuelStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentLocationMensuelStoreRequest $request)
    {
        $paymentLocationMensuel = PaymentLocationMensuel::create($request->validated());

        $request->session()->flash('paymentLocationMensuel.id', $paymentLocationMensuel->id);

        return redirect()->route('paymentLocationMensuel.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PaymentLocationMensuel $paymentLocationMensuel
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PaymentLocationMensuel $paymentLocationMensuel)
    {
        return view('paymentLocationMensuel.show', compact('paymentLocationMensuel'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PaymentLocationMensuel $paymentLocationMensuel
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, PaymentLocationMensuel $paymentLocationMensuel)
    {
        return view('paymentLocationMensuel.edit', compact('paymentLocationMensuel'));
    }

    /**
     * @param \App\Http\Requests\PaymentLocationMensuelUpdateRequest $request
     * @param \App\Models\PaymentLocationMensuel $paymentLocationMensuel
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentLocationMensuelUpdateRequest $request, PaymentLocationMensuel $paymentLocationMensuel)
    {
        $paymentLocationMensuel->update($request->validated());

        $request->session()->flash('paymentLocationMensuel.id', $paymentLocationMensuel->id);

        return redirect()->route('paymentLocationMensuel.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PaymentLocationMensuel $paymentLocationMensuel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PaymentLocationMensuel $paymentLocationMensuel)
    {
        $paymentLocationMensuel->delete();

        return redirect()->route('paymentLocationMensuel.index');
    }
}
