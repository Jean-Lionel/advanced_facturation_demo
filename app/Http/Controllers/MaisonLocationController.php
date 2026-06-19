<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaisonLocationStoreRequest;
use App\Http\Requests\MaisonLocationUpdateRequest;
use App\Models\ClientMaison;
use App\Models\MaisonLocation;
use App\Models\PaymentLocationMensuel;
use App\Models\PeriodePaimentLocation;
use Illuminate\Http\Request;

class MaisonLocationController extends Controller
{

    public function index(Request $request)
    {

        $search = $request->input('search');
        $maisonLocations = MaisonLocation::with(['clients' => function($query) use ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }])
                                    ->orWhere(function($query) use ($search) {
                                        if($search){
                                            $query->where('name', '=', $search);
                                        }
                                    })
                                    ->withCount('clients')
                                    ->latest()->get();
                                    //->paginate(10);

        $this->ensureCurrentPaymentPeriode();

        $periodes = PeriodePaimentLocation::latest()->take(3)->get();

        $paymentSums = PaymentLocationMensuel::query()
            ->whereIn('maisonlocation_id', $maisonLocations->pluck('id'))
            ->whereIn('periode_paiement_id', $periodes->pluck('id'))
            ->selectRaw('maisonlocation_id, periode_paiement_id, SUM(montant) as total_paid')
            ->groupBy('maisonlocation_id', 'periode_paiement_id')
            ->get()
            ->keyBy(fn ($payment) => $payment->maisonlocation_id . '-' . $payment->periode_paiement_id);

        $maisonLocations = sortMaisonsByUnpaidStatus($maisonLocations, $periodes, $paymentSums);

        return view('maisonLocation.index', compact('maisonLocations', 'search', 'periodes', 'paymentSums'));
    }

    public function create(Request $request)
    {
        return view('maisonLocation.create');
    }

    public function store(MaisonLocationStoreRequest $request)
    {

        $maisonLocation = MaisonLocation::create($request->validated());


        $request->session()->flash('maisonLocation.id', $maisonLocation->id);

        return$this->index($request);
    }

    public function show(Request $request, MaisonLocation $maisonLocation)
    {
        return view('maisonLocation.show', compact('maisonLocation'));
    }


    public function edit(Request $request, MaisonLocation $maisonLocation)
    {

        return view('maisonLocation.edit', compact('maisonLocation'));
    }

    /**
     * @param \App\Http\Requests\MaisonLocationUpdateRequest $request
     * @param \App\Models\MaisonLocation $maisonLocation
     * @return \Illuminate\Http\Response
     */
    public function update(MaisonLocationUpdateRequest $request, MaisonLocation $maisonLocation)
    {
        $maisonLocation->update($request->validated());

        $request->session()->flash('maisonLocation.id', $maisonLocation->id);

        return redirect()->route('maisonLocation.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MaisonLocation $maisonLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, MaisonLocation $maisonLocation)
    {
        $maisonLocation->delete();

        return redirect()->route('maisonLocation.index');
    }

    private function ensureCurrentPaymentPeriode(): void
    {
        $check = PeriodePaimentLocation::where('month', date('m'))
            ->where('year', date('Y'))
            ->first();

        if (is_null($check)) {
            PeriodePaimentLocation::create([
                'month' => date('m'),
                'year' => date('Y'),
                'user_id' => auth()->user()->id,
            ]);
        }
    }
}
