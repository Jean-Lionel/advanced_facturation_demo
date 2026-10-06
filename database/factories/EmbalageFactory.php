<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Embalage;
use App\Models\TypeEmbalage;

class EmbalageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Embalage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'price' => $this->faker->randomFloat(0, 0, 9999999999.),
            'quantity' => $this->faker->randomFloat(0, 0, 9999999999.),
            'type_embalage_id' => TypeEmbalage::factory(),
        ];
    }
}
