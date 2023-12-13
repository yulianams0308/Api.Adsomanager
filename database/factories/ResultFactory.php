<?php

namespace Database\Factories;

use Doctrine\Inflector\Rules\Word;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Instructor;
use App\Models\Competence;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Result>
 */
class ResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // return [
        //     'nombre_resultado' => $this->faker->sentence(),
        //     'descripcion' => $this->faker->sentence(),
        //     'horas' => $this->faker->randomNumber,
        //     'fecha_inicio' => $this->faker->date,
        //     'fecha_fin' => $this->faker->date,
        //     'url_formato' => $this->faker->word,
        //     // 'instructor_id' => \App\Models\Instructor::factory(), // Utiliza el factory de Instr
        //     'competence_id' => \App\Models\Competence::factory(), // Utiliza el factory de Competence
        //      'slug'=>$this-> faker->sentence(),
        // ];

        return [
            'nombre_resultado' => $this->faker->sentence,
            'descripcion' => $this->faker->sentence,
            'horas' => $this->faker->numberBetween(10, 100),
            'fecha_inicio' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'fecha_fin' => $this->faker->dateTimeBetween('now', '+1 year'),
            'url_formato' => $this->faker->url,
            'slug' => $this->faker->unique()->slug,
            'instructor_id'=>\App\Models\Instructor::factory(),
            // 'instructor_id' => Instructor::inRandomOrder()->first()->id,
            'competence_id' => Competence::inRandomOrder()->first()->id,
        ];

    }
}
