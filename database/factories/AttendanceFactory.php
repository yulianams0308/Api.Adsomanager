<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Instructor;
use App\Models\Session;
use App\Models\Apprentice;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'asistio' =>$this->faker->boolean, // Valor booleano aleatorio (true o false)
            'slug' =>$this->faker->unique()->slug,
            'instructor_id' =>Instructor::inRandomOrder()->first()->id, // Relación con Instructor
            'session_id' =>Session::inRandomOrder()->first()->id, // Relación con Session
            'aprendiz_id' =>Apprentice::inRandomOrder()->first()->id, // Relación con Apprentice
        ];
    }
}
