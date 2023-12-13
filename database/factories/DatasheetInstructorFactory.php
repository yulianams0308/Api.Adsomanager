<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Datasheet;
use App\Models\Instructor;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DatasheetInstructorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ficha_id' => App\Models\Datasheet::inRandomOrder()->first()->id,
            'instructor_id' => App\Models\Instructor::inRandomOrder()->first()->id,
        ];
    }
}
