<?php

namespace Database\Seeders;

use App\Models\UserTransactionType;
use Illuminate\Database\Seeder;

class UserTransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserTransactionType::factory()->count(5)->create();
    }
}
