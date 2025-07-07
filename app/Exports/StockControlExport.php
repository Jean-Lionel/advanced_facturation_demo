<?php

namespace App\Exports;

use App\Models\StockControl;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StockControlExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $dateFrom;
    protected $dateTo;
    protected $filters;

    public function __construct($dateFrom, $dateTo, $filters = [])
    {
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = StockControl::with(['product.category', 'user'])
            ->whereBetween('created_at', [
                $this->dateFrom . ' 00:00:00',
                $this->dateTo . ' 23:59:59'
            ]);

        if (isset($this->filters['product_id']) && $this->filters['product_id']) {
            $query->where('product_id', $this->filters['product_id']);
        }

        if (isset($this->filters['category_id']) && $this->filters['category_id']) {
            $query->whereHas('product', function($q) {
                $q->where('category_id', $this->filters['category_id']);
            });
        }

        if (isset($this->filters['search']) && $this->filters['search']) {
            $query->whereHas('product', function($q) {
                $q->where('name', 'like', '%' . $this->filters['search'] . '%')
                  ->orWhere('code_product', 'like', '%' . $this->filters['search'] . '%');
            });
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Date',
            'Produit',
            'Code Produit',
            'Catégorie',
            'Stock Ancien',
            'Nouveau Stock',
            'Quantité Vendue',
            'Prix Unitaire',
            'Total Vente',
            'Utilisateur',
            'Description'
        ];
    }

    public function map($stockControl): array
    {
        return [
            $stockControl->created_at->format('d/m/Y H:i'),
            $stockControl->product->name ?? 'Produit supprimé',
            $stockControl->product->code_product ?? '',
            $stockControl->product->category->name ?? '',
            number_format($stockControl->old_quantity, 2),
            number_format($stockControl->new_quantity, 2),
            number_format($stockControl->sold_quantity, 2),
            number_format($stockControl->price, 0),
            number_format($stockControl->total, 0),
            $stockControl->user->name ?? 'User ' . $stockControl->user_id,
            strip_tags($stockControl->description)
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                  'fill' => ['fillType' => 'solid', 'color' => ['rgb' => '4472C4']]],
        ];
    }
}
