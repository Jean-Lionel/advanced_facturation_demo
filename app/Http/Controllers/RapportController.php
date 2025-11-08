<?php

namespace App\Http\Controllers;

use App\Models\BienvenuHistorique;
use App\Models\Client;
use App\Models\Depense;
use App\Models\Order;
use App\Models\OrderInteret;
use App\Models\StockControl;
use App\Models\User;
use App\Models\PaymentInteret;
use App\Models\Versement;
use App\Models\Compte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $commissionnairesData = Compte::where('montant', '>', 0)
            ->whereIn('client_id', array_unique($ids['commissionnaires']))
            ->whereHas('client', function ($query) {
                $query->where('is_commissionaire','!=',null );
            })
            ->with(['client:id,name'])
            ->orderByDesc('montant')
            ->get(['id', 'client_id', 'montant']);


        $clientsData = Compte::where('montant', '>', 0)
            ->whereIn('client_id', array_unique($ids['clients']))
            ->whereHas('client', function ($query) {
                $query->where('is_commissionaire',NULL );
            })
            ->with(['client:id,name'])
            ->orderByDesc('montant')
            ->get(['id', 'client_id', 'montant']);


        // Récupérer les derniers paiements (si variable existe)
        $historiquesPayment = PaymentInteret::with('client')
            ->latest()
            ->limit(10)
            ->get();

        return view('reports.partage', compact(
            'interets',
            'totaux',
            'commissionnairesData',
            'clientsData',
            'historiquesPayment'
        ));
    }

    /**
     * Enregistrer un paiement d'intérêt
     */
    public function paiement_interet(Request $request)
    {
        try {
            $validated = $request->validate([
                'compte_id' => 'required|exists:comptes,id',
                'client_id' => 'required|exists:clients,id',
                'type' => 'required|in:client,commissionnaire',
                'montant' => 'required|numeric|min:0',
                'remarque' => 'nullable|string|max:500'
            ]);
            // dd($validated);

            DB::beginTransaction();

            $compte  = Compte::findOrFail($validated['compte_id']);

            if($compte && $compte->montant > $validated['montant']){
                $compte->montant -=$validated['montant'];
                $compte->save();
            }else{
                 return response()->json([
                        'success' => false,
                        'message' => 'Le compte non trouve ou le compte est insuffisant, Verifie le solde disponible',
                        'errors' => null
                    ]);
            }

           BienvenuHistorique::create([
                'compte_id' =>  $validated['compte_id'] ,
                'client_id' =>  $validated['client_id'] ,
                'mode_payement' => 1,
                'title' => 'Retrait de commissions',
                'montant' => $validated['montant'],
                'description' => "Retrait de commissions pour le client  du compte" . $validated['compte_id'],
                'user_id' => auth()->user()->id
            ]);

            // Créer l'enregistrement de paiement
            $payment = PaymentInteret::create([
                'client_id' => $validated['client_id'],
                'title' => $validated['type'] === 'client' ? 'Commission du Client' : 'Commission du Commissionnaire',
                'montant' => $validated['montant'],
                'remarque' => $validated['remarque'],
                'type_beneficiaire' => $validated['type'],
                'date_paiement' => now(),
                'statut' => 'payé'
            ]);



            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Paiement enregistré avec succès',
                'payment_id' => $payment->id
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
