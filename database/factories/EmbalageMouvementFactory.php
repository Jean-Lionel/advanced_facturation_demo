<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\Embalage;
use App\Models\EmbalageMouvement;

class EmbalageMouvementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmbalageMouvement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'quantity' => $this->faker->randomFloat(0, 0, 9999999999.),
            'embalage_id' => Embalage::factory(),
            'client_id' => Client::factory(),
        ];
    }
}
