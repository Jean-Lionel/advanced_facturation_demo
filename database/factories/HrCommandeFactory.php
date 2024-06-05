<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\HrCommande;
use App\Models\Order;
use App\Models\User;

class HrCommandeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HrCommande::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'order_id' => Order::factory(),
            'is_paid_at' => $this->faker->word,
            'total_command' => $this->faker->randomFloat(0, 0, 9999999999.),
            'softdeletes' => $this->faker->word,
        ];
    }
}
