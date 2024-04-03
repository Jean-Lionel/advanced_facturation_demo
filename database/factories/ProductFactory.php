<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Product::class;

    /**
    * Define the model's default state.
    *name
    code_product
    name
    quantite
    price
    date_expiration

    * @return array
    */
    public function definition()
    {
        $price =  $this->faker->buildingNumber;
        return [
            'name' => $this->getRandomItem() .'_'. rand(1, 10) ,//$this->faker->name,
            'code_product' => rand(1, 10000),
            'price' => $price ,
            'quantite' => 0,
            'date_expiration' => $this->faker->date,
            'category_id' => Category::all()->random()->id,
            'price_max' => $price  + round( $price * 0.05),
            'unite_mesure' => 'NA',
            'price_min' => $price - round( $price * 0.05) ,
            'quantite_alert' => 1,
        ];
    }

    public function getRandomItem(){
        $table = array("APPLE", "BANANA", "ORANGE", "GRAPE", "KIWI", "MANGO", "PAPAYA", "PINEAPPLE", "STRAWBERRY" , "STYLO" , "LAMPE" , "CISEAUX", "TABLETTE", "ORDINATEUR", "ECRAN", "CLOUS", "CIMENT", "TOLES", "PAPIER", "CLAVIER");
        // Get a random key from the array
        $random_key = array_rand($table);

        // Get the value associated with the random key
       return  $table[$random_key];
    }
}
