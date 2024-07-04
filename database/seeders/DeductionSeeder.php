<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hrm_retenue_type')->insert([
            "name_retenue_type" => "Dégradation de Matériel",
            "createdBy_retenue_type" => 1
        ], [
            "name_retenue_type" => "Avance Sur Salaire",
            "createdBy_retenue_type" => 1
        ]);
    }
}
