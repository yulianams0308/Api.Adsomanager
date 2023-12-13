<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Datasheet;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apprentice>
 */
class ApprenticeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'estado' =>$this->faker->randomElement(['Activo', 'Inactivo', 'En proceso']),
            'etapa' =>$this->faker->randomElement(['LECTIVA', 'PRODUCTIVA']),
            'slug' =>$this->faker->unique()->slug,
            'ficha_id' =>Datasheet::inRandomOrder()->first()->id, // Relación con Datasheet
            'user_id' =>User::inRandomOrder()->first()->id, // Relación con User
        ];
    }
}
