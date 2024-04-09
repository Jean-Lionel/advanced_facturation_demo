<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\Commande;
use App\Models\CommandeDetail;
use App\Models\Product;
use App\Models\User;

class CommandeDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommandeDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'commande_id' => Commande::factory(),
            'client_id' => Client::factory(),
            'product_id' => Product::factory(),
            'quantite' => $this->faker->randomFloat(0, 0, 9999999999.),
            'quantite_livre' => $this->faker->randomFloat(0, 0, 9999999999.),
            'price_commande' => $this->faker->randomFloat(0, 0, 9999999999.),
            'price_livraison' => $this->faker->randomFloat(0, 0, 9999999999.),
            'description' => $this->faker->text,
        ];
    }
}
