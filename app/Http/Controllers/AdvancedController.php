<?php

namespace App\Http\Controllers;

use App\Models\Transaction as ModelsTransaction;
use App\Models\Member;
use App\Models\Document;
use App\Models\Organisation;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvancedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Récupération des filtres
        $selectedYear = $request->input('year', now()->year);
        $selectedMemberId = $request->input('member_id');
        $selectedOrganisationId = $request->input('organisation');

        // Années disponibles pour le filtre (depuis la première transaction)
        $firstTransactionYear = ModelsTransaction::min(DB::raw('YEAR(date_transaction)')) ?? now()->year;
        $availableYears = range(2023, now()->year);
        $availableYears = array_reverse($availableYears);

        // Tous les membres pour le filtre
        $allMembers = Member::orderBy('firstname')->orderBy('last_name')->get();

        // Dernières transactions avec relations (filtrées si nécessaire)
        $latestTransactionsQuery = ModelsTransaction::with(['transactionType', 'member'])
            ->whereYear('date_transaction', $selectedYear);

        if ($selectedMemberId) {
            $latestTransactionsQuery->where('member_id', $selectedMemberId);
        }
        if ($selectedOrganisationId) {
            $latestTransactionsQuery->whereHas('member', function($q) use ($selectedOrganisationId) {
                $q->where('organisation_id', $selectedOrganisationId);
            });
        }

        $latestTransactions = $latestTransactionsQuery->latest('date_transaction')->take(10)->get();

        // Calcul des statistiques pour l'année sélectionnée
        $currentMonth = now()->month;
        $currentYear = (int) $selectedYear;
        $isCurrentYear = $currentYear === now()->year;

        // Pour les comparaisons, on utilise le mois précédent de l'année sélectionnée
        $comparisonMonth = $isCurrentYear ? now()->subMonth() : now()->setYear($currentYear)->endOfYear();

        // Membres actifs
        $activeMembersCount = Member::where('is_active', true)->count();

        // Nouveaux membres de l'année sélectionnée
        $newMembersThisYear = Member::whereYear('created_at', $currentYear)->count();
        $newMembersLastYear = Member::whereYear('created_at', $currentYear - 1)->count();
        $membersDiff = $newMembersThisYear - $newMembersLastYear;

        // Revenus de l'année (avec filtre membre si sélectionné)
        $revenueQuery = ModelsTransaction::whereYear('date_transaction', $currentYear);
        if ($selectedMemberId) {
            $revenueQuery->where('member_id', $selectedMemberId);
        }
        if ($selectedOrganisationId) {
            $revenueQuery->whereHas('member', function($q) use ($selectedOrganisationId) {
                $q->where('organisation_id', $selectedOrganisationId);
            });
        }
        $revenueThisYear = $revenueQuery->sum('montant');

        $revenueLastYearQuery = ModelsTransaction::whereYear('date_transaction', $currentYear - 1);
        if ($selectedMemberId) {
            $revenueLastYearQuery->where('member_id', $selectedMemberId);
        }
        if ($selectedOrganisationId) {
            $revenueLastYearQuery->whereHas('member', function($q) use ($selectedOrganisationId) {
                $q->where('organisation_id', $selectedOrganisationId);
            });
        }
        $revenueLastYear = $revenueLastYearQuery->sum('montant');

        $revenuePercentChange = $revenueLastYear > 0
            ? round((($revenueThisYear - $revenueLastYear) / $revenueLastYear) * 100, 1)
            : ($revenueThisYear > 0 ? 100 : 0);

        // Documents de l'année
        $documentsThisYear = Document::whereYear('created_at', $currentYear)->count();
        $documentsLastYear = Document::whereYear('created_at', $currentYear - 1)->count();
        $documentsDiff = $documentsThisYear - $documentsLastYear;

        // Total des transactions de l'année (avec filtres)
        $transactionsQuery = ModelsTransaction::whereYear('date_transaction', $currentYear);
        if ($selectedMemberId) {
            $transactionsQuery->where('member_id', $selectedMemberId);
        }
        if ($selectedOrganisationId) {
            $transactionsQuery->whereHas('member', function($q) use ($selectedOrganisationId) {
                $q->where('organisation_id', $selectedOrganisationId);
            });
        }
        $transactionsThisYear = $transactionsQuery->count();

        $transactionsLastYearQuery = ModelsTransaction::whereYear('date_transaction', $currentYear - 1);
        if ($selectedMemberId) {
            $transactionsLastYearQuery->where('member_id', $selectedMemberId);
        }
        if ($selectedOrganisationId) {
            $transactionsLastYearQuery->whereHas('member', function($q) use ($selectedOrganisationId) {
                $q->where('organisation_id', $selectedOrganisationId);
            });
        }
        $transactionsLastYear = $transactionsLastYearQuery->count();
        $transactionsDiff = $transactionsThisYear - $transactionsLastYear;

        // Documents récents
        $newDocuments = Document::with('user')->latest()->take(5)->get();

        $stats = [
            'activeMembers' => $activeMembersCount,
            'membersDiff' => $membersDiff,
            'totalRevenue' => $revenueThisYear,
            'revenuePercentChange' => $revenuePercentChange,
            'newDocuments' => $newDocuments,
            'documentsThisYear' => $documentsThisYear,
            'documentsDiff' => $documentsDiff,
            'transactionsThisYear' => $transactionsThisYear,
            'transactionsDiff' => $transactionsDiff,
        ];

        // Données pour les graphiques - transactions par mois (avec filtres)
        $transactionsByMonthQuery = ModelsTransaction::select(
            DB::raw('MONTH(date_transaction) as month'),
            DB::raw('YEAR(date_transaction) as year'),
            DB::raw('SUM(montant) as total')
        )
        ->whereYear('date_transaction', $currentYear);

        if ($selectedMemberId) {
            $transactionsByMonthQuery->where('member_id', $selectedMemberId);
        }
        if ($selectedOrganisationId) {
            $transactionsByMonthQuery->whereHas('member', function($q) use ($selectedOrganisationId) {
                $q->where('organisation_id', $selectedOrganisationId);
            });
        }

        $transactionsByMonth = $transactionsByMonthQuery
            ->groupBy('month', 'year')
            ->orderBy('month')
            ->get()
            ->map(function($item) use ($currentYear) {
                $item->date_transaction = now()->setDate($currentYear, $item->month, 1);
                return $item;
            });

        // Répartition des membres par organisation
        $membersByOrganisation = Member::select('organisation_id', DB::raw('COUNT(*) as count'))
            ->groupBy('organisation_id')
            ->with(['organisation'])
            ->get()
            ->filter(fn($item) => $item->organisation !== null);

        // Transactions par membre selon le mois (avec filtres)
        $transactionsByMemberQuery = ModelsTransaction::select(
            'member_id',
            DB::raw('MONTH(date_transaction) as month'),
            DB::raw('YEAR(date_transaction) as year'),
            DB::raw('SUM(montant) as total'),
            DB::raw('COUNT(*) as count')
        )
        ->whereYear('date_transaction', $currentYear)
        ->whereNotNull('member_id');

        if ($selectedMemberId) {
            $transactionsByMemberQuery->where('member_id', $selectedMemberId);
        }
        if ($selectedOrganisationId) {
            $transactionsByMemberQuery->whereHas('member', function($q) use ($selectedOrganisationId) {
                $q->where('organisation_id', $selectedOrganisationId);
            });
        }

        $transactionsByMemberAndMonth = $transactionsByMemberQuery
            ->with(['member:id,firstname,last_name'])
            ->groupBy('member_id', 'month', 'year')
            ->orderBy('month')
            ->orderBy('member_id')
            ->get()
            ->map(function($item) {
                if ($item->member) {
                    $item->member_name = trim($item->member->firstname . ' ' . $item->member->last_name);
                } else {
                    $item->member_name = 'Membre inconnu';
                }
                $item->month_name = \Carbon\Carbon::create($item->year, $item->month, 1)->translatedFormat('F Y');
                return $item;
            })
            ->groupBy('member_id');

        // Transactions par type (avec filtres)
        $transactionsByTypeQuery = ModelsTransaction::select(
            'transaction_type_id',
            DB::raw('SUM(montant) as total'),
            DB::raw('COUNT(*) as count')
        )
        ->whereYear('date_transaction', $currentYear)
        ->whereNotNull('transaction_type_id');

        if ($selectedMemberId) {
            $transactionsByTypeQuery->where('member_id', $selectedMemberId);
        }
        if ($selectedOrganisationId) {
            $transactionsByTypeQuery->whereHas('member', function($q) use ($selectedOrganisationId) {
                $q->where('organisation_id', $selectedOrganisationId);
            });
        }

        $transactionsByType = $transactionsByTypeQuery
            ->with(['transactionType:id,name'])
            ->groupBy('transaction_type_id')
            ->orderByDesc('total')
            ->get()
            ->map(function($item) {
                $item->type_name = $item->transactionType?->name ?? 'Non defini';
                return $item;
            });

        // Transactions par type et par mois (pour graphique d'evolution)
        $transactionsByTypeAndMonthQuery = ModelsTransaction::select(
            'transaction_type_id',
            DB::raw('MONTH(date_transaction) as month'),
            DB::raw('YEAR(date_transaction) as year'),
            DB::raw('SUM(montant) as total'),
            DB::raw('COUNT(*) as count')
        )
        ->whereYear('date_transaction', $currentYear)
        ->whereNotNull('transaction_type_id');

        if ($selectedMemberId) {
            $transactionsByTypeAndMonthQuery->where('member_id', $selectedMemberId);
        }
        if ($selectedOrganisationId) {
            $transactionsByTypeAndMonthQuery->whereHas('member', function($q) use ($selectedOrganisationId) {
                $q->where('organisation_id', $selectedOrganisationId);
            });
        }

        $transactionsByTypeAndMonth = $transactionsByTypeAndMonthQuery
            ->with(['transactionType:id,name'])
            ->groupBy('transaction_type_id', 'month', 'year')
            ->orderBy('month')
            ->orderBy('transaction_type_id')
            ->get()
            ->map(function($item) {
                $item->type_name = $item->transactionType?->name ?? 'Non defini';
                return $item;
            })
            ->groupBy('transaction_type_id');

        // Nouveaux membres
        $newMembers = Member::with(['organisation'])
            ->latest()
            ->take(5)
            ->get();

        // Organisations et utilisateurs pour les filtres
        $organisations = Organisation::all();
        $users = User::all();

        // Filtres actifs pour la vue
        $filters = [
            'year' => $selectedYear,
            'member_id' => $selectedMemberId,
            'organisation' => $selectedOrganisationId,
        ];

        return view('advanced.dashboard', compact(
            'latestTransactions',
            'stats',
            'transactionsByMonth',
            'membersByOrganisation',
            'transactionsByMemberAndMonth',
            'transactionsByType',
            'transactionsByTypeAndMonth',
            'newMembers',
            'organisations',
            'users',
            'availableYears',
            'allMembers',
            'filters'
        ));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
