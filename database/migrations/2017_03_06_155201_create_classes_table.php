<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao');
            $table->string('sigla')->nullable();
            $table->string('turno')->nullable();
            $table->string('ano')->nullable();
        });

        Schema::create('student_class', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_id')->unsigned();
            $table->integer('classs_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('classs_id')->references('id')->on('classes');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_class');
          Schema::dropIfExists('classes');
    }
}
