<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_resultado');
            $table->string('descripcion');
            $table->integer('horas');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->string('url_formato');

            $table->string('slug')->unique();

            $table->unsignedBigInteger('instructor_id');
            $table->foreign('instructor_id')
                ->references('id')
                ->on('instructors')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('competence_id');
            $table->foreign('competence_id')
            ->references('id')
            ->on('competences')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
