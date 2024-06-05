<?php

namespace Database\Seeders;

use App\Models\HrFicheDetail;
use Illuminate\Database\Seeder;

class HrFicheDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HrFicheDetail::factory()->count(5)->create();
    }
}
