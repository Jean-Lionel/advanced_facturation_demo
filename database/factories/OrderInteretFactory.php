<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderInteret;
use App\Models\User;

class OrderInteretFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderInteret::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => Order::factory(),
            'user_id' => User::factory(),
            'montant' => $this->faker->randomFloat(0, 0, 9999999999.),
            'description' => $this->faker->text,
            'softdeletes' => $this->faker->word,
        ];
    }
}
