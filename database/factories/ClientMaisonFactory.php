<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\ClientMaison;
use App\Models\MaisonLocation;
use App\Models\User;

class ClientMaisonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClientMaison::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'client_id' => Client::factory(),
            'maisonlocation_id' => MaisonLocation::factory(),
            'description' => $this->faker->text,
            'montant' => $this->faker->randomFloat(0, 0, 9999999999.),
            'softdeletes' => $this->faker->word,
        ];
    }
}
