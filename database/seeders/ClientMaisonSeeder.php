<?php

namespace Database\Seeders;

use App\Models\ClientMaison;
use Illuminate\Database\Seeder;

class ClientMaisonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClientMaison::factory()->count(5)->create();
    }
}
