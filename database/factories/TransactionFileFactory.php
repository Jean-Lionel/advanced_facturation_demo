<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Transaction;
use App\Models\TransactionFile;
use App\Models\User;

class TransactionFileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TransactionFile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'file_url' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'user_id' => User::factory(),
            'transaction_id' => Transaction::factory(),
        ];
    }
}
