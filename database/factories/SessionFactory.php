<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Instructor;
use App\Models\Room;
use App\Models\Datasheet;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Session>
 */
class SessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // return [
        //     'observacion' => $this->faker->sentence,
        //     'fecha_inicio' => $this->faker->date(),
        //     'fecha_fin' => $this->faker->date(),
        //     'ficha_id' => \App\Models\Datasheet::factory(), // Utiliza el factory de Datasheet
        //     'ambiente_id' => \App\Models\Room::factory(), // Utiliza el factory de Room
        //     'slug'=>$this-> faker->sentence(),
        // ];
        return [
            'observacion' => $this->faker->sentence,
            'fecha_inicio' => $this->faker->dateTimeThisMonth,
            'fecha_fin' => $this->faker->dateTimeThisMonth,
            'slug' => $this->faker->unique()->slug,
            'ficha_id' => Datasheet::inRandomOrder()->first()->id, // Relación con Datasheet
            'ambiente_id' => Room::inRandomOrder()->first()->id, // Relación con Room
            'instructor_id' => Instructor::inRandomOrder()->first()->id, // Relación con Instructor
        ];
    }
}
