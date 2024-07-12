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
                       
        return view('LocationMaison.All.index', compact('clientsMaisonnonpay'));
    }
}
