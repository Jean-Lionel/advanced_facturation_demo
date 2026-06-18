<?php

namespace Database\Seeders;

use App\Models\DepenseCategory;
use Illuminate\Database\Seeder;

class DepenseCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Salaires', 'description' => 'Paiement du personnel'],
            ['name' => 'Loyer', 'description' => 'Loyer du local ou bureau'],
            ['name' => 'Transport', 'description' => 'Frais de déplacement et transport'],
            ['name' => 'Fournitures', 'description' => 'Achats de fournitures diverses'],
            ['name' => 'Autres', 'description' => 'Dépenses non classées'],
        ];

        foreach ($categories as $category) {
            DepenseCategory::firstOrCreate(['name' => $category['name']], $category);
        }
    }
}