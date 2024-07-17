<?php

namespace Database\Seeders;

use App\Models\PaymentLocationMensuel;
use Illuminate\Database\Seeder;

class PaymentLocationMensuelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentLocationMensuel::factory()->count(5)->create();
    }
}
