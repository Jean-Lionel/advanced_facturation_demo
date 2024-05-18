<?php

namespace Database\Seeders;

use App\Models\HrFiche;
use Illuminate\Database\Seeder;

class HrFicheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HrFiche::factory()->count(5)->create();
    }
}
