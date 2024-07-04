<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndeminitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hrm_type_indeminite')->insert([
            "title" => "Logement",
            "percentage" => 65,
            "taxable" => 1,
            "created_by" => 1
        ], [
            "title" => "Déplacement",
            "percentage" => 15,
            "taxable" => 1,
            "created_by" => 1
        ]);
    }
}
