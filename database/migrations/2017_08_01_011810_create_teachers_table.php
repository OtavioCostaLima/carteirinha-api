<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('user_id')->unsigned()->unique()->nullable();
            $table->string('cpf')->unique();
            $table->string('bairro')->nullable();
            $table->string('sexo',1)->nullable();
            $table->string('ctps')->nullable();
            $table->date('data_emissao')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('grau_instrucao')->nullable();
            $table->string('numero_residencia')->nullable();
            $table->string('orgao_emissor')->nullable();
            $table->string('pis_pasep')->nullable();
            $table->string('pos_graduacao')->nullable();
            $table->string('cidade')->nullable();
            $table->string('etinia')->nullable();
            $table->string('rg')->nullable();
            $table->string('cep')->nullable();
            $table->string('endereco')->nullable();
            $table->string('celular')->nullable();
            $table->string('naturalidade')->nullable();
            $table->string('nascionalidade')->nullable();
            $table->string('profissao')->nullable();
            $table->string('complemento')->nullable();
            $table->string('estado')->nullable();
            $table->string('email')->nullable();
            $table->integer('user_id')->unsigned()->unique()->nullable();
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
        Schema::dropIfExists('teachers');
    }
}
