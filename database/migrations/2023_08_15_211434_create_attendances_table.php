<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->boolean('asistio');
// 'id','asistio','instructor_id','session_id','session_id','aprendiz_id'
            $table->string('slug')->unique();
            $table->unsignedBigInteger('instructor_id');
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('aprendiz_id');

            $table->foreign('instructor_id')
            ->references('id')
            ->on('instructors')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('session_id')
                ->references('id')
                ->on('sessions')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('aprendiz_id')
                ->references('id')
                ->on('apprentices')
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
        Schema::dropIfExists('attendances');
    }
}
