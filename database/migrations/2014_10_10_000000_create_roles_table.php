<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Facade;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_rol');

            $table->timestamps();
        });
        // Insertar registros por defecto
        // DB::table('roles')->insert([
        //     ['nombre_rol' => 'Administrador'],
        //     ['nombre_rol' => 'Instructor'],
        //     ['nombre_rol' => 'Aprendiz'],
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
