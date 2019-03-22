<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    //CT_001.10 - Se retornar true o usuário está sendo cadastrado com sucesso;
    //CT_001.19 - O mesmo método vale para o alterar senha   
    public function cadastrar()
    {
        $user = new User();
        $user->name = $this->generateRandomString();
        $user->email= $this->generateRandomString()."@email.com";
        $user->password = bcrypt("123456");
        $this->assertTrue($user->save());
    }

    /** @test */
    //CT_001.21 - Se retornar true a senha está correta;
    public function verificar_senha(){
        $user = $this->incluirUser();
        $this->assertTrue($user->validarSenha("123456"));
    }

    /** @test */
    //CT_001.23 - Se retornar true excluiu com corretamente;
    public function excluir(){
        $user = $this->incluirUser();
        $this->assertTrue($user->delete());
    }

    //gera string aleatória
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    //inclui usuário
    function incluirUser(){
        $user = new User();
        $user->name = $this->generateRandomString();
        $user->email= $this->generateRandomString()."@email.com";
        $user->password = bcrypt("123456");
        $user->save();
        return $user;
    }
    
}
