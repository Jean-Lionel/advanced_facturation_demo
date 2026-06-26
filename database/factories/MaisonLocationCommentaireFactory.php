<?php

namespace Database\Factories;

use App\Models\MaisonLocation;
use App\Models\MaisonLocationCommentaire;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaisonLocationCommentaireFactory extends Factory
{
    protected $model = MaisonLocationCommentaire::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'maisonlocation_id' => MaisonLocation::factory(),
            'date' => $this->faker->date(),
            'nom' => $this->faker->name,
            'telephone' => $this->faker->phoneNumber,
            'commentaire' => $this->faker->paragraph,
        ];
    }
}