<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect([
            ['ID', 'Name', 'Marque', 'Unite de Mesure', 'Quantite', 'Quantite alert','prix d\'Achat', 'Taux du tva', 'date d\'Expiration', 'Description'],
        ]);
    }
}
