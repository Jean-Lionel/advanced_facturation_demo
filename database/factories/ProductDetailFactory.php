<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Stocke;
use App\Models\User;

class ProductDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductDetail::class;

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
            'product_id' => Product::factory(),
            'prix_revient' => $this->faker->randomFloat(0, 0, 9999999999.),
            'quantite' => $this->faker->randomFloat(0, 0, 9999999999.),
            'quantite_restant' => $this->faker->randomFloat(0, 0, 9999999999.),
            'description' => $this->faker->text,
        ];
    }
}
