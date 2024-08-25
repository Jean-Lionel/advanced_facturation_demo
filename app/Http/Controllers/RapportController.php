<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\OrderInteret;
use App\Models\User;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    //

    public function rapport_detail(){

        return view('reports.index');
    }

    public function partage_interet(){
        $interets = OrderInteret::latest()->get();


         // Initialiser les tableaux pour stocker les totaux et les noms
         $commissionnaireTotals = [];
         $clientTotals = [];
         $entrepriseTotal = 0;
         $informaticienTotal = 0;

        $commissionnaires = [];
        $clients = [];

         // Parcourir tous les éléments du tableau
         foreach ($interets as $interet) {
            $description = json_decode($interet->description, true);

            if ($description) {
                $partage = $description['partage'] ?? [];
                $commissionnaireId = $description['commissionaire_id'];
                $clientId = $description['client_id'];

                //  l'informaticien
                if (isset($partage['Informaticien'])) {
                    $informaticienTotal += $partage['Informaticien'];
                }

                // l'entreprise
                if (isset($partage['Entreprise'])) {
                    $entrepriseTotal += $partage['Entreprise'];
                }

                //  commissionnaire
                if ($commissionnaireId) {
                    if (!isset($commissionnaireTotals[$commissionnaireId])) {
                        $commissionnaireTotals[$commissionnaireId] = 0;
                    }
                    $commissionnaireTotals[$commissionnaireId] += $partage['Commisionnaire'] ?? 0;
                }

                // client
                if (!isset($clientTotals[$clientId])) {
                    $clientTotals[$clientId] = 0;
                }
                $clientTotals[$clientId] += $partage['Client'] ?? 0;

                if ($commissionnaireId) {
                    $commissionnaires[] = $commissionnaireId;
                }
                if ($clientId) {
                    $clients[] = $clientId;
                }
            }
        }

        $commissionnairesData = Client::whereIn('id', $commissionnaires)->pluck('name', 'id');
        $clientsData = Client::whereIn('id', $clients)->pluck('name', 'id');

        return view('reports.partage', compact('interets','commissionnaireTotals', 'clientTotals', 'entrepriseTotal','informaticienTotal','commissionnairesData','clientsData'));

    }
}
