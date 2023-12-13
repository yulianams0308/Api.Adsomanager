<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Datasheet;
use App\Models\Competence;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CompetenceDatasheetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ficha_id' => Datasheet::inRandomOrder()->first()->id, // Relación con Datasheet
            'competencia_id' => Competence::inRandomOrder()->first()->id, // Relación con Competence
        ];
    }
}
