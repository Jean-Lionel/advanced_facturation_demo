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
    public function index()
    {
        // Dernières transactions
        $latestTransactions = ModelsTransaction::with(['transactionType'])
            ->latest()
            ->take(5)
            ->get();

        // Statistiques
        $stats = [
            'activeMembers' => Member::where('is_active', true)->count(),
            'totalRevenue' => 0, // ModelsTransaction::where('type', 'credit')->sum('montant'),
            'newDocuments' => Document::latest()->take(5)->get(),
            'activeTasks' => 0 , //Task::where('status', 'in_progress')->count()
        ];

        // Données pour les graphiques
        $transactionsByMonth = ModelsTransaction::select(
            DB::raw('MONTH(date_transaction) as month'),
            DB::raw('YEAR(date_transaction) as year'),
            DB::raw('SUM(montant) as total')
        )
        ->whereYear('date_transaction', now()->year)
        ->groupBy('month', 'year')
        ->orderBy('month')
        ->get()
        ->map(function($item) {
            $item->date_transaction = now()->setDate(now()->year, $item->month, 1);
            return $item;
        });

        $membersByOrganisation = Member::select('organisation_id', DB::raw('COUNT(*) as count'))
            ->groupBy('organisation_id')
            ->with(['organisation'])
            ->get();

        // Nouveaux membres
        $newMembers = Member::with(['organisation'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function($member) {
                $member->created_at = new \Carbon\Carbon($member->created_at);
                return $member;
            });

        // Organisations pour le filtre
        $organisations = Organisation::all();
        $users = User::all();

        return view('advanced.dashboard', compact(
            'latestTransactions',
            'stats',
            'transactionsByMonth',
            'membersByOrganisation',
            'newMembers',
            'organisations',
            'users'
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
