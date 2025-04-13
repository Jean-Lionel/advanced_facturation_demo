<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\Document;
use App\Models\Member;
use App\Models\TransactionFile;
use App\Models\User;

class DocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Document::class;

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
            'client_id' => Client::factory(),
            'document_type' => $this->faker->word,
            'transaction_file_id' => TransactionFile::factory(),
            'name' => $this->faker->name,
            'description' => $this->faker->text,
        ];
    }
}
