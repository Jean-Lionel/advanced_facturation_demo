<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\MaisonLocation;
use App\Models\PaymentLocationMensuel;
use App\Models\User;

class PaymentLocationMensuelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentLocationMensuel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'maisonlocation_id' => MaisonLocation::factory(),
            'description' => $this->faker->text,
            'montant' => $this->faker->randomFloat(0, 0, 9999999999.),
            'date_paiement' => $this->faker->date(),
            'softdeletes' => $this->faker->word,
        ];
    }
}
