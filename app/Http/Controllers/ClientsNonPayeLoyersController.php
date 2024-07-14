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
        $totalImpaye = 0;
        $nbreClientsNonPayeurs = 0;
        $clientsMaisonTotal= ClientMaison::count();
        foreach ($clientsMaisonnonpay as  $clientMaison) {
            $totalImpaye +=  $clientMaison->maisonlocation->montant;
            $nbreClientsNonPayeurs++;
            $nbreClientsNonPayeurs_percentage=round(($nbreClientsNonPayeurs / $clientsMaisonTotal) * 100, 2);
        }
        return view('LocationMaison.index',[
            'clientsMaisonnonpay'=> $clientsMaisonnonpay,
            'nbreClientsNonPayeurs'=>$nbreClientsNonPayeurs,
            'clientsMaisonTotal'=>  $clientsMaisonTotal,
            'nbreClientsNonPayeurs_percentage'=>$nbreClientsNonPayeurs_percentage,
            'totalImpaye'=>  $totalImpaye 
        ]);
    } else {
        return redirect()->back()->with('error', 'Veuillez saisir une date de début et une date de fin.');
    }
}
}
