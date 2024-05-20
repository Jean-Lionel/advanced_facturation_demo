<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\CommissionDetail;
use App\Models\Compte;
use App\Models\Order;
use App\Models\User;

class CommissionDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommissionDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'compte_id' => Compte::factory(),
            'client_id' => Client::factory(),
            'order_id' => Order::factory(),
            'user_id' => User::factory(),
            'montant' => $this->faker->randomFloat(0, 0, 9999999999.),
            'activite' => $this->faker->word,
            'description' => $this->faker->text,
            'softdeletes' => $this->faker->word,
        ];
    }
}
