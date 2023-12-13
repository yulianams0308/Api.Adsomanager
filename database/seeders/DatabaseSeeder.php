<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Apprentice;
use App\Models\Competence;
use App\Models\Datasheet;
use App\Models\Instructor;
use App\Models\Result;
use App\Models\Role;
use App\Models\Room;
use App\Models\Session;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Image;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         // Crear roles
         Role::factory()->create([
            'nombre_rol' => 'Administrador',
        ]);

        Role::factory()->create([
            'nombre_rol' => 'Instructor',
        ]);

        Role::factory()->create([
            'nombre_rol' => 'Aprendiz',
        ]);

        // Crear instructores y competencias
        Instructor::factory(10)->create()->each(function ($instructor) {

            Competence::factory()->create([
                'instructor_id' => $instructor->id,
            ]);


        });

        //Crear registros en la tabla 'results' con las relaciones
        $instructors = Instructor::all();
        $competences = Competence::all();

        Result::factory(10)->create()->each(function ($result) use ($instructors, $competences) {
            $result->instructor_id = $instructors->random()->id;
            $result->competence_id = $competences->random()->id;
            $result->save();
        });
        Room::factory()->count(10)->create();

        Datasheet::factory()->count(10)->create();

        $datasheets = Datasheet::all();
        $competences = Competence::all();


        Session::factory()->count(10)->create();

        Apprentice::factory(10)->create()->each(function ($apprentice) {
            $datasheet = Datasheet::inRandomOrder()->first();
            $user = User::inRandomOrder()->first();

            $apprentice->ficha_id = $datasheet->id;
            $apprentice->user_id = $user->id;
            $apprentice->save();
        });

        Attendance::factory(10)->create();

        $datasheets = Datasheet::all();
        $competences = Competence::all();

        // Itera sobre cada datasheet y asocia competencias aleatorias
        foreach ($datasheets as $datasheet) {
            $competencesToAssociate = $competences->random(mt_rand(1, 5)); // Asocia de 1 a 5 competencias aleatorias
            $datasheet->competences()->attach($competencesToAssociate);
        }


        // Itera sobre cada datasheet y asocia instructores aleatorios
        foreach ($datasheets as $datasheet) {
            $instructorsToAssociate = $instructors->random(mt_rand(1, 10));
            $datasheet->instructors()->attach($instructorsToAssociate);
        }

        // Image::factory(20)->create();
    }


}
    //     //Role::factory(0)->create();
    //     User::factory(10)->create();
    //    //Image::factory(10)->create();
    //     // Competence::factory(10)->create();
    //     Result::factory(10)->create();
    //     Datasheet::factory(10)->create();


        // $session = Session::factory()->create();

        // $datasheetId = 20;

        // $session->datasheet()->associate($datasheetId);

        // // Instructor::factory(10)->create();

        // Instructor::factory()
        // ->create()
        // ->each(function ($instructor) {
        //     // Obtén el ID de la ficha que deseas asignar (reemplaza 1 con el ID de la ficha real)
        //     $datasheetId = 20;

        //     // Asigna la ficha existente al instructor
        //     $instructor->datasheets()->attach($datasheetId);
        // });

        // Room::factory(10)->create();
        // // Session::factory(10)->create();
        // Session::factory()
        // ->create()
        // ->each(function ($session)
        // {
        //     // $datasheetId = 20;
        //     // $session->datasheets()->attach($datasheetId);
        // });
