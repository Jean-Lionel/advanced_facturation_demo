<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Stocke;
use App\Models\User;

class CommandeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Commande::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'stock_id' => Stocke::factory(),
            'client_id' => Client::factory(),
            'type_commande' => $this->faker->text,
            'stock_demandant' => Stocke::factory()->create()->stock_demandant,
            'stock_livrant' => Stocke::factory()->create()->stock_livrant,
            'description' => $this->faker->text,
        ];
    }
}
