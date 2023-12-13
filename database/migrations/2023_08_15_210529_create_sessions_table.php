<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->string('observacion');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');

            $table->unsignedBigInteger('ficha_id')->nullable();
            $table->unsignedBigInteger('ambiente_id')->nullable();
            $table->unsignedBigInteger('instructor_id')->nullable();

            $table->string('slug')->unique();

            $table->foreign('ficha_id')
            ->references('id')
            ->on('datasheets')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('ambiente_id')
            ->references('id')
            ->on('rooms')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('instructor_id')
            ->references('id')
            ->on('instructors')
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
        Schema::dropIfExists('sessions');
    }
}
