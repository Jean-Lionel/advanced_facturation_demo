<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Banque;
use App\Models\User;

class BanqueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Banque::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->company,
            'account_name' => $this->faker->company,
            'account_number' => $this->faker->numerify('############'),
            'account_type' => 'CURRENT ACCOUNT',
            'currency' => $this->faker->randomElement(['BIF', 'USD', 'EUR']),
            'description' => $this->faker->text,
            'is_active' => true,
        ];
    }
}
