<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('contratos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('endereco', 255)->nullable();
            $table->string('preco', 255)->nullable();
            $table->string('observacoes', 255)->nullable();
            $table->boolean('em_andamento');
            $table->dateTime('data_fim')->nullable();
            $table->dateTime('data_inicio')->nullable();
            $table->dateTime('data_gerado')->nullable();
            $table->dateTime('data_assinatura')->nullable();
            $table->dateTime('data_realizado')->nullable();
            $table->string('avaliacao_cmt', 255)->nullable();
            $table->double('avaliacao_nota', 5, 2)->nullable();
            $table->integer('cidade_id')->unsigned();
            $table->foreign('cidade_id')->references('id')->on('cidades');
            $table->integer('oferta_id')->unsigned();
            $table->foreign('oferta_id')->references('id')->on('ofertas');
            $table->integer('contratante_id')->unsigned();
            $table->foreign('contratante_id')->references('id')->on('users');
            
            
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
        Schema::dropIfExists('contratos');
    }
}
