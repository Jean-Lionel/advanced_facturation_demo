<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\AssuranceClient;

class AssuranceClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AssuranceClient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => $this->faker->numberBetween(-10000, 10000),
            'assurance_id' => $this->faker->numberBetween(-10000, 10000),
            'expire_date' => $this->faker->date(),
            'par_client' => $this->faker->randomFloat(0, 0, 9999999999.),
            'par_assurance' => $this->faker->randomFloat(0, 0, 9999999999.),
            'description' => $this->faker->text,
        ];
    }
}
