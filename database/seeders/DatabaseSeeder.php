<?php

namespace Database\Seeders;

use App\Models\Stocke;
use App\Models\RoleUser;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();
        \App\Models\Entreprise::factory(1)->create();
        \App\Models\Client::factory(4)->create();
        \App\Models\Stocke::factory(1)->create();
        \App\Models\Category::factory(2)->create();
        \App\Models\Product::factory(10)->create();

        Stocke::create([
            'name' => 'STOCK PRINCIPAL',
            'description' => 'STOCK PRINCIPAL DE BASE'
        ]);

        RoleUser::create([
            'role_id' => 1,
            'user_id' => 1
        ]);
        \App\Models\Role::create(['name' => 'ADMINISTRATEUR']);
        \App\Models\Role::create(['name' => 'CONTROLLEUR']);
        \App\Models\Role::create(['name' => 'COMPTABLE']);
        \App\Models\Role::create(['name' => 'VENTE']);
        \App\Models\Role::create(['name' => 'ENTRE DES PRODUITS EN STOCK']);

        $this->call([
            BankSeeder::class,
            PosteSeeder::class,
            DeductionSeeder::class,
            IndeminitySeeder::class,
            LeaveSeeder::class,
            DepartmentSeeder::class,
        ]);
    }
}
