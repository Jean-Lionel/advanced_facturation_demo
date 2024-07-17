<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\MaisonLocation;
use App\Models\User;

class MaisonLocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MaisonLocation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'montant' => $this->faker->randomFloat(0, 0, 9999999999.),
            'softdeletes' => $this->faker->word,
        ];
    }
}
