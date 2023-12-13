<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // return [
        //     'imageable_id' => $this->faker->numberBetween(1, 100), //
        //     'imageable_type' => $this->faker->randomElement(['App\Models\User','App\Models\Role']), // Cambia esto con los modelos relacionados
        //     'url' => $this->faker->imageUrl(),
        //     'updated_at' =>$this->faker->dateTime(),
        //     'created_at'=>$this->faker->dateTime(),
        // ];
        return [
            'url' =>$this->faker->imageUrl, // Genera una URL de imagen aleatoria
            'imageable_type' => 'App\\Models\\User', // Establece el tipo de relación como 'User'
            'imageable_id' =>User::inRandomOrder()->first()->id, // Relación con User
            'user_id' => User::inRandomOrder()->first()->id, // Relación con User
        ];
    }
}
