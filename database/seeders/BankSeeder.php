<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hrm_bank')->insert([
            "bank_name" => "BCB",
            "created_by" => 1
        ], [
            "bank_name" => "BANCOBU",
            "created_by" => 1
        ], [
            "bank_name" => "MUTEC",
            "created_by" => 1
        ]);
    }
}
