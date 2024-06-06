<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Fich;
use App\Models\HrCommande;
use App\Models\HrFicheDetail;
use App\Models\User;

class HrFicheDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HrFicheDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'fiche_id' => Fich::factory(),
            'commande_id' => HrCommande::factory(),
            'date_debut' => $this->faker->date(),
            'date_fin' => $this->faker->date(),
            'description' => $this->faker->text,
            'softdeletes' => $this->faker->word,
        ];
    }
}
