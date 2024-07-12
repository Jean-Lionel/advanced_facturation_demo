<?php

namespace App\Http\Controllers;
use App\Models\ClientMaison;
use Illuminate\Http\Request;
use App\Models\PaymentLocationMensuel;
use App\Models\MaisonLocation;
use Carbon\Carbon;

class ClientsNonPayeLoyersController extends Controller
{
    public function index(Request $request)
{
    $dateDebut = $request->input('dateDebut',date('Y-m-d', strtotime('-1 month')));
    $dateFin = $request->input('dateFin', date('Y-m-d'));

    if ($dateDebut && $dateFin) {
        $idsMaisons = PaymentLocationMensuel::whereBetween('date_paiement', [
            Carbon::parse($dateDebut)->startOfDay(),
            Carbon::parse($dateFin)->endOfDay(),
        ])->pluck('maisonlocation_id')->toArray();

        $nonpayMaisons = MaisonLocation::whereNotIn('id', $idsMaisons)->get();
        $idsMaisonsnonpay = $nonpayMaisons->pluck('id')->toArray();

        $clientsMaisonnonpay = ClientMaison::whereIn('maisonlocation_id', $idsMaisonsnonpay)
                            ->with('client')
                            ->get();

        return view('LocationMaison.index', compact('clientsMaisonnonpay'));
    } else {
        return redirect()->back()->with('error', 'Veuillez saisir une date de début et une date de fin.');
    }
}
}
