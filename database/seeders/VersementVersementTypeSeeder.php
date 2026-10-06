<?php

namespace Database\Seeders;

use App\Models\VersementVersementType;
use Illuminate\Database\Seeder;

class VersementVersementTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VersementVersementType::factory()->count(5)->create();
    }
}
