<?php

namespace Database\Seeders;

use App\Models\ClientHistory;
use Illuminate\Database\Seeder;

class ClientHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClientHistory::factory()->count(5)->create();
    }
}
