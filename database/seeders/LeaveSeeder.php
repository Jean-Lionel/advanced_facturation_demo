<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hrm_leave_category')->insert([
            "category" => "Congé Annuel",
            "created_by" => 1
        ], [
            "category" => "Congé Maternité",
            "created_by" => 1
        ]);
    }
}
