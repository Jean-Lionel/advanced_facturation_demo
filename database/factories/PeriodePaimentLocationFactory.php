<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\PeriodePaimentLocation;
use App\Models\User;

class PeriodePaimentLocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PeriodePaimentLocation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'year' => $this->faker->word,
            'month' => $this->faker->word,
            'status' => $this->faker->word,
            'softdeletes' => $this->faker->word,
        ];
    }
}
