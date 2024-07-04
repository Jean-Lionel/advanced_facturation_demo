<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hrm_department')->insert([
            "title" => "Administration",
            "created_by" => 1
        ], [
            "title" => "Commercial",
            "created_by" => 1
        ]);
    }
}
