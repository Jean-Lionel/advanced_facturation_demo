<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Location\PaymentMensuel;
use App\Models\ClientMaison;
use Illuminate\Http\Request;
use App\Models\PaymentLocationMensuel;
use App\Models\MaisonLocation;
use Illuminate\Support\Facades\DB;

class ClientsNonPayeLoyersAllController extends Controller
{
    public function index(Request $request)
    {
        $idsMaisons = PaymentLocationMensuel::whereDate('date_paiement', '>=', now()->subMonths(1))
                        ->pluck('maisonlocation_id')
                        ->toArray();
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
        return view('LocationMaison.All.index',[
                'clientsMaisonnonpay'=> $clientsMaisonnonpay,
                'nbreClientsNonPayeurs'=>$nbreClientsNonPayeurs,
                'clientsMaisonTotal'=>  $clientsMaisonTotal,
                'nbreClientsNonPayeurs_percentage'=>$nbreClientsNonPayeurs_percentage,
                'totalImpaye'=>  $totalImpaye 
        ]);
    }
}
