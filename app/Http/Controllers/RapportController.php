<?php

namespace App\Http\Controllers;

use App\Models\BienvenuHistorique;
use App\Models\Client;
use App\Models\Depense;
use App\Models\Order;
use App\Models\OrderInteret;
use App\Models\StockControl;
use App\Models\User;
use App\Models\Versement;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    //

    public function rapportResultats(){

        //$resultats = Stock vendu-Versements-Charges-depenses=0;
       // $orders = Order::all();
        $start_date = request()->query('start_date');
        $end_date = request()->query('end_date');
        $controls = StockControl::whereBetween('created_at', [$start_date, $end_date])->get();
        $depenses = Depense::whereBetween('created_at', [$start_date, $end_date])->get();
        $versements = Versement::whereBetween('created_at', [$start_date, $end_date])->get();

        return view('reports.resultats', compact('controls','depenses','versements','start_date','end_date'));
    }

    public function rapport_detail(){

        return view('reports.index');
    }

    public function partage_interet()
    {
        $interets = OrderInteret::with(['order', 'client', 'commisionnaire'])->latest()->get();

        $totaux = [
            'entreprise' => 0,
            'informaticien' => 0,
            'commissionnaires' => [],
            'clients' => []
        ];

        $ids = ['commissionnaires' => [], 'clients' => []];

        foreach ($interets as $interet) {
            $description = json_decode($interet->description, true);

            if (!$description || !isset($description['partage'])) continue;

            $partage = $description['partage'];
            $commissionnaireId = $description['commissionaire_id'] ?? null;
            $clientId = $description['client_id'] ?? null;

            // Totaux globaux
            $totaux['informaticien'] += $partage['Informaticien'] ?? 0;
            $totaux['entreprise'] += $partage['Entreprise'] ?? 0;

            // Totaux commissionnaires
            if ($commissionnaireId) {
                $totaux['commissionnaires'][$commissionnaireId] =
                    ($totaux['commissionnaires'][$commissionnaireId] ?? 0) + ($partage['Commisionnaire'] ?? 0);
                $ids['commissionnaires'][] = $commissionnaireId;
            }

            // Totaux clients
            if ($clientId) {
                $totaux['clients'][$clientId] =
                    ($totaux['clients'][$clientId] ?? 0) + ($partage['Client'] ?? 0);
                $ids['clients'][] = $clientId;
            }
        }

        // Récupérer les noms
        $commissionnairesData = Client::whereIn('id', array_unique($ids['commissionnaires']))
            ->pluck('name', 'id');
        $clientsData = Client::whereIn('id', array_unique($ids['clients']))
            ->pluck('name', 'id');

        return view('reports.partage', compact(
            'interets',
            'totaux',
            'commissionnairesData',
            'clientsData'
        ));
    }
}
