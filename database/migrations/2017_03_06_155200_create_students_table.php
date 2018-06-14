<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('students', function (Blueprint $table) {
          $table->string('id')->unique();
          $table->string('nome')->nullable();
          $table->string('telefone')->nullable();
          $table->string('email')->nullable();
          $table->integer('parent_id')->unsigned()->nullable();
          $table->foreign('parent_id')->references('id')->on('parents');
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
        Schema::dropIfExists('students');
    }
}
