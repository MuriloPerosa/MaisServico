<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNecessidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('necessidades', function (Blueprint $table) {
            $table->increments('id');

            $table->string('titulo', 255);
            $table->string('descricao', 255);
            $table->string('observacoes', 255)->nullable();
            $table->string('email', 100);
            $table->string('telefone', 25)->nullable();
            $table->string('celular', 25)->nullable();
            $table->date('data_limite');
            $table->boolean('ativo');
            $table->integer('cidade_id')->unsigned();
            $table->foreign('cidade_id')->references('id')->on('cidades');
            $table->integer('categoria_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('necessidades');
    }
}
