<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public static $headers = ['ID', 'Code du product', 'Name', 'Marque', 'Unite de Mesure', 'Quantite', 'Quantite alert','prix d\'Achat', 'Prix de Vente', 'Taux du tva',  'Description'];

    public static $headersNames = ['id', 'code_product', 'name', 'marque', 'unite_mesure', 'quantite', 'quantite_alert','price_min', 'price',  'taux_tva',  'description'];
    public function collection()
    {
        return collect([
            self::$headers
        ]);
    }
}
