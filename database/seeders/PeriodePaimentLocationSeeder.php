<?php

namespace Database\Seeders;

use App\Models\PeriodePaimentLocation;
use Illuminate\Database\Seeder;

class PeriodePaimentLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PeriodePaimentLocation::factory()->count(5)->create();
    }
}
