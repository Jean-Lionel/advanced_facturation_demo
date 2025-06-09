<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Versement;

class VersementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Versement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'description' => $this->faker->text,
            'montant' => $this->faker->randomFloat(0, 0, 9999999999.),
            'date_transaction' => $this->faker->date(),
        ];
    }
}
