<?php

namespace Database\Seeders;

use App\Models\HrChambre;
use Illuminate\Database\Seeder;

class HrChambreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HrChambre::factory()->count(5)->create();
    }
}
