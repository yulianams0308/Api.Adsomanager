<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Datasheet>
 */
class DatasheetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // return [
        //     'numero_ficha'=>$this->faker->unique()->randomNumber(),
        //     'programa'=>$this->faker->text,
        //     'slug'=>$this-> faker->sentence(),
        // ];
        return [
            'numero_ficha' =>$this->faker->unique()->randomNumber(7), // Genera un número aleatorio único de dígitos
            'programa' =>$this->faker->sentence(2), // Genera una oración aleatoria de 2 palabras
            'slug' =>$this->faker->unique()->slug,
            'user_id'=>User::inRandomOrder()->first()->id,
        ];
    }
}
