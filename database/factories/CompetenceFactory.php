<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Instructor;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Competence>
 */
class CompetenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // return [

        //      'nombre_competencia'=>$this-> faker->sentence(),
        //      'descripcion'=>$this->faker->sentence(),
        //      'anexo'=>$this-> faker->sentence(),
        //      'slug'=>$this-> faker->sentence(),
        //      'instructor_id'=>\App\Models\Instructor::factory(), // Utiliza el factory de Instructor
        // ];
        return [
            'nombre_competencia' =>$this->faker->sentence,
            'descripcion' =>$this->faker->sentence,
            'anexo' =>$this->faker->word,
            //  'instructor_id' => function () {
            //      return Instructor::inRandomOrder()->first()->id;
            // },
            'instructor_id'=>Instructor::factory(),
            // 'instructor_id' => Instructor::inRandomOrder()->first()->id, // Asigna un instructor válido
            'slug' =>$this->faker->unique()->slug,
        ];
    }
}
