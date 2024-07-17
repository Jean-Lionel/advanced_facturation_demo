<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\BienvenuHistorique;
use App\Models\Client;
use App\Models\Compte;

class BienvenuHistoriqueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BienvenuHistorique::class;

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
            'mode_payement' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'title' => $this->faker->sentence(4),
            'montant' => $this->faker->randomFloat(0, 0, 9999999999.),
            'description' => $this->faker->text,
        ];
    }
}
