<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // composer require fzaninotto/faker

        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->integer('num_salon');
            $table->string('sede');
            $table->integer('capacidad');
            $table->string('observacion');

            $table->string('slug')->unique();

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
        Schema::dropIfExists('rooms');
    }
}
