<?php

namespace App\Exports;

use App\Models\Depense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DepenseExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $startDate;
    protected $endDate;
    protected $search;

    public function __construct($startDate, $endDate, $search = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->search = $search;
    }

    public function collection()
    {
        return Depense::filteredReport($this->startDate, $this->endDate, $this->search)->get();
    }

    public function headings(): array
    {
        return [
            'Date',
            'Action',
            'Catégorie',
            'Montant (FBu)',
            'Description',
            'Enregistré par',
        ];
    }

    public function map($depense): array
    {
        return [
            $depense->date_depense
                ? $depense->date_depense->format('d/m/Y')
                : $depense->created_at->format('d/m/Y'),
            $depense->name,
            $depense->category->name ?? '-',
            number_format($depense->montant, 2, ',', ' '),
            $depense->description,
            $depense->user->name ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'color' => ['rgb' => '4472C4']],
            ],
        ];
    }
}