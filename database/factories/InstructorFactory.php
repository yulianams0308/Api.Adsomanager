<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Instructor;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instructor>
 */
class InstructorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // return [

        //     'profesion'=>$this->faker->word(),
        //     'user_id' => \App\Models\User::factory(), // Utiliza el factory de user
        //      'slug'=>$this-> faker->sentence(),
        // ];
        return [
            'profesion' =>$this->faker->jobTitle,
            // 'user_id' => User::inRandomOrder()->first()->id, // Relación con User
            // 'user_id' => User::whereNotIn('id', Instructor::pluck('user_id'))->inRandomOrder()->first()->id,
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'slug' =>$this->faker->unique()->slug,
        ];
    }
}
