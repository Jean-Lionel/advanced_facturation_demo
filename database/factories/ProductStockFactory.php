<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Stocke;
use App\Models\User;

class ProductStockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductStock::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'product_id' => Product::factory(),
            'stock_id' => Stocke::factory(),
            'quantity' => $this->faker->randomFloat(0, 0, 9999999999.),
            'prix_revient' => $this->faker->randomFloat(0, 0, 9999999999.),
            'prix_vente' => $this->faker->randomFloat(0, 0, 9999999999.),
            'user_id' => User::factory(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
