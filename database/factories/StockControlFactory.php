<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\StockControl;
use App\Models\User;

class StockControlFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StockControl::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'old_quantity' => $this->faker->randomFloat(0, 0, 9999999999.),
            'new_quantity' => $this->faker->randomFloat(0, 0, 9999999999.),
            'sold_quantity' => $this->faker->randomFloat(0, 0, 9999999999.),
            'price' => $this->faker->randomFloat(0, 0, 9999999999.),
            'description' => $this->faker->text,
            'user_id' => User::factory(),
        ];
    }
}
