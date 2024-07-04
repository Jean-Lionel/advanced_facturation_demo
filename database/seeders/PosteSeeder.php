<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PosteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hrm_fonctions')->insert([
            "title" => "ADG",
            "department_id" => 1,
            "created_by" => 1
        ], [
            "title" => "Caissiere",
            "department_id" => 2,
            "created_by" => 1
        ]);
    }
}
