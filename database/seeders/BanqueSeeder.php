<?php

namespace Database\Seeders;

use App\Models\Banque;
use Illuminate\Database\Seeder;

class BanqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Banque::factory()->count(5)->create();
    }
}
