<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientMaison;

class ClientsNonPayeLoyersAllController extends Controller
{
    public function index(Request $request)
    {
        $nonPayeurs = ClientMaison::whereDoesntHave('payments', function ($query) {
            $query->whereDate('date_paiement', '>=', now()->subMonths(1));
        })
        ->with(['client', 'maisonlocation'])
        ->get();

        return view('LocationMaison.nonPays.index',compact('nonPayeurs'));
    }
}
