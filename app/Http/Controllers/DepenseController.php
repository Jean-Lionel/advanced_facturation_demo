<?php

namespace App\Http\Controllers;

use App\Exports\DepenseExport;
use App\Models\Depense;
use App\Models\DepenseCategory;
use App\Models\Entreprise;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DepenseController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $totalMontant = null;

        $query = Depense::with(['user', 'category'])->latest('date_depense');

        if ($startDate && $endDate) {
            $query->filteredReport($startDate, $endDate, $search);
            $totalMontant = (clone $query)->sum('montant');
        } elseif ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $depenses = $query->paginate(20)->appends($request->query());

        return view('depenses.index', compact(
            'search',
            'depenses',
            'startDate',
            'endDate',
            'totalMontant'
        ));
    }

    public function create()
    {
        $depenseCategories = DepenseCategory::orderBy('name')->get();

        return view('depenses.create', compact('depenseCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'montant' => 'required|numeric|min:0',
            'depense_category_id' => 'required|exists:depense_categories,id',
            'date_depense' => 'required|date',
            'description' => 'nullable|string',
        ]);

        Depense::create($request->only([
            'name',
            'montant',
            'description',
            'depense_category_id',
            'date_depense',
        ]));

        return redirect()->route('depenses.index');
    }

    public function show(Depense $depense)
    {
        //
    }

    public function edit(Depense $depense)
    {
        $depenseCategories = DepenseCategory::orderBy('name')->get();

        return view('depenses.edit', compact('depense', 'depenseCategories'));
    }

    public function update(Request $request, Depense $depense)
    {
        $request->validate([
            'name' => 'required|min:2',
            'montant' => 'required|numeric|min:0',
            'depense_category_id' => 'required|exists:depense_categories,id',
            'date_depense' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $depense->update($request->only([
            'name',
            'montant',
            'description',
            'depense_category_id',
            'date_depense',
        ]));

        return redirect()->route('depenses.index');
    }

    public function destroy(Depense $depense)
    {
        $depense->delete();

        return redirect()->route('depenses.index');
    }

    public function exportExcel(Request $request)
    {
        $filters = $this->validatePeriodFilters($request);

        $filename = 'depenses_' . $filters['start_date'] . '_' . $filters['end_date'] . '.xlsx';

        return Excel::download(
            new DepenseExport($filters['start_date'], $filters['end_date'], $filters['search']),
            $filename
        );
    }

    public function exportPdf(Request $request)
    {
        $filters = $this->validatePeriodFilters($request);
        $report = $this->buildReportData($filters);

        $pdf = Pdf::loadView('depenses.pdf', $report);
        $pdf->setPaper('a4', 'landscape');

        $filename = 'depenses_' . $filters['start_date'] . '_' . $filters['end_date'] . '.pdf';

        return $pdf->download($filename);
    }

    public function print(Request $request)
    {
        $filters = $this->validatePeriodFilters($request);
        $report = $this->buildReportData($filters);

        return view('depenses.print', $report);
    }

    private function validatePeriodFilters(Request $request): array
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'search' => 'nullable|string',
        ]);

        return [
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'search' => $request->get('search'),
        ];
    }

    private function buildReportData(array $filters): array
    {
        $depenses = Depense::filteredReport(
            $filters['start_date'],
            $filters['end_date'],
            $filters['search']
        )->get();

        return [
            'depenses' => $depenses,
            'startDate' => $filters['start_date'],
            'endDate' => $filters['end_date'],
            'totalMontant' => $depenses->sum('montant'),
            'entreprise' => Entreprise::currentEntreprise(),
        ];
    }
}