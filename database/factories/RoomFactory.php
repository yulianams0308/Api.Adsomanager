<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // return [
        //     'num_salon' => $this->faker->numberBetween(100,200),
        //     'sede' => $this->faker->word,
        //     'capacidad' => $this->faker->numberBetween(10, 100), // Cambia esto con el rango deseado
        //     'observacion' => $this->faker->sentence,
        //     'slug'=>$this-> faker->sentence(),
        // ];
        return [
            'num_salon' => $this->faker->unique()->numberBetween(1, 100), // Número de salón único entre 1 y 100
            'sede' => $this->faker->city, // Ciudad aleatoria
            'capacidad' => $this->faker->numberBetween(10, 100), // Capacidad aleatoria entre 10 y 100
            'observacion' => $this->faker->text, // Observación aleatoria
            'slug' => $this->faker->unique()->slug, // Slug único generado a partir del nombre del salón
        ];
    }
}
