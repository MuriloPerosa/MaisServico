<?php

namespace Tests\Unit;

use App\Pessoa;
use App\User;
use Tests\TestCase;
//use Faker\Generator as Faker;

class PessoaTest extends TestCase
{

    /** @test
     *  @expectedException \Illuminate\Database\QueryException*/
    //CT_001.2 - Verifca o campo cpf como obrigatório
    //CT_001.14
    public function cpf_required()
    {
        $user = User::where('email', 'perosamurilo@gmail.com')->first();
        $pessoa = new Pessoa();

        // $pessoa->cpf = 40221016015;
        $pessoa->rg = "444444444";
        $pessoa->telefone = "32731272";
        $pessoa->celular = "996443378";
        $pessoa->data_nascimento = "06/05/1998";
        $pessoa->cidade_id = "7";
        $pessoa->user_id = $user->id;
        $pessoa->save();
        $this->expectException(QueryException::class);
    }

    //CT_001.3 - Se retornar true o CPF já está cadastrado no sistema;
    //CT_001.15
    /** @test */
    public function cpf_unico()
    {
        $this->assertTrue(Pessoa::cpfCadastrado("40221016015"));
    }

     //CT_001.4 - Se retornar true o CPF é válido;
     //CT_001.16
    /** @test */
    public function cpf_valido()
    {
        $this->assertTrue(Pessoa::validarCPF("40221016015"));
    }

     //CT_001.5 - Se retornar false a pessoa tem menos de 18 anos;
     //CT_001.17
    /** @test */
    public function idade_pessoa()
    {
        $this->assertFalse(Pessoa::validarDataNascimento("2010-05-06"));
    }

    /** @test */
    //CT_001.3 - Se retornar true o RG já está cadastrado no sistema;
    public function rg_unico(){
        $this->assertTrue(Pessoa::rgCadastrado("1234567891011"));
    }

     /** @test */
     //CT_001.10 - Se retornar true a pessoa está sendo cadastrada com sucesso;
     //CT_001.13 - O mesmo método vale para o alterar pessoa;
    public function cadastrar_alterar(){
        $pessoa = factory(Pessoa::class)->make();
        $this->assertTrue($pessoa->save());
}
   
}
