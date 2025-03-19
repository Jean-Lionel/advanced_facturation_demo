<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Member;
use App\Models\Organisation;
use App\Models\User;

class MemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Member::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
            'title' => $this->faker->sentence(4),
            'profile_image' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->text,
            'description' => $this->faker->text,
            'is_active' => $this->faker->boolean,
            'organisation_id' => Organisation::factory(),
            'user_id' => User::factory(),
        ];
    }
}
