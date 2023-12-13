<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatasheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datasheets', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_ficha')->unique();
            $table->string('programa');

            $table->string('slug')->unique();
            $table->timestamps();
        });
        //'id,'numero_ficha','programa','slug'
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datasheets');
    }
}
