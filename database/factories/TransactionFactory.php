<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Member;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'member_id' => Member::factory(),
            'transaction_type_id' => TransactionType::factory(),
            'montant' => $this->faker->randomFloat(0, 0, 9999999999.),
            'description' => $this->faker->text,
            'date_transaction' => $this->faker->date(),
        ];
    }
}
