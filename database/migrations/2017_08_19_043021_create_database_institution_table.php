<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabaseInstitutionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('database_institution', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('institution_id');
            $table->string('driver');
            $table->string('host');
            $table->string('database');
            $table->string('username');
            $table->string('password');
            $table->string('charset')->default('utf8');
            $table->string('collation')->default('utf8_unicode_ci');
            $table->string('prefix')->default('');
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
        //
    }
}
