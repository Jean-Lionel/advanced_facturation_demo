<?php

namespace Database\Seeders;

use App\Models\MaisonLocation;
use Illuminate\Database\Seeder;

class MaisonLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MaisonLocation::factory()->count(5)->create();
    }
}
