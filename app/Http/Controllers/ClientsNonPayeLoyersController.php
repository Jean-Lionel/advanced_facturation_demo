<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientMaison;
use App\Models\MaisonLocation;
use App\Models\PaymentLocationMensuel;
use Carbon\Carbon;

class ClientsNonPayeLoyersController extends Controller
{
   public function index(Request $request)
   {
         $dateDebut = $request->input('dateDebut');
       $dateFin = $request->input('dateFin');
   
       $clientsMaisons = ClientMaison::with(['client', 'maisonlocation', 'payments' => function ($query) use ($dateDebut, $dateFin) {
           $query->whereBetween('date_paiement', [$dateDebut, $dateFin]);
       }])
       ->get();
   
             $nonPayeurs = $clientsMaisons->filter(function ($clientMaison) use ($dateDebut, $dateFin) {
           $payments = $clientMaison->payments->filter(function ($payment) use ($dateDebut, $dateFin) {
               return $payment->date_paiement >= $dateDebut && $payment->date_paiement <= $dateFin;
           });
           return $payments->count() === 0;
       });
   
       $totalImpaye = 0;
       $nbreNonPayeurs = 0;
   
       $nonPayeursData = [];
   
       foreach ($nonPayeurs as $nonPayeur) {
           $totalImpaye += $nonPayeur->maisonlocation->montant;
           $nbreNonPayeurs++;
   
           $nonPayeursData[] = [
               'name' => $nonPayeur->client->name,
               'telephone' => $nonPayeur->client->telephone,
               'adresse' => $nonPayeur->maisonlocation->adresse,
               'montant' => $nonPayeur->maisonlocation->montant,
               'maison_louee'=> $nonPayeur->maisonlocation->name,
           ];
           
           if ($nonPayeur->payments()->count() > 0) {
               $nonPayeursData[count($nonPayeursData) - 1]['description'] = $nonPayeur->payments()->latest()->first()->description;
           } else {
               $nonPayeursData[count($nonPayeursData) - 1]['description'] = '-';
           }
           $dernierPaiement = $nonPayeur->payments()->orderBy('date_paiement', 'desc')->first();
   
           if ($dernierPaiement) {
                $nonPayeursData[count($nonPayeursData) - 1]['Derniereecheance'] = $dernierPaiement->date_paiement ? $dernierPaiement->date_paiement->format('d/m/Y') : 'Jamais payé';
           } else {
                $nonPayeursData[count($nonPayeursData) - 1]['Derniereecheance'] = 'Jamais payé';
           }   
           
       }
   
       return view('LocationMaison.index', compact('nonPayeursData', 'dateDebut', 'dateFin', 'totalImpaye', 'nbreNonPayeurs'));
   }

}
