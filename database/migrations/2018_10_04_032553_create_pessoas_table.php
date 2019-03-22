<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cpf', 15)->unique();
            $table->string('rg', 25)->unique();
            $table->string('telefone', 25)->nullable();
            $table->string('celular', 25)->nullable();
            //$table->boolean('administrador');
            $table->date('data_nascimento');
            $table->integer('cidade_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('cidade_id')->references('id')->on('cidades');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('pessoas');
    }
}
