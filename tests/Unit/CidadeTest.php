<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Cidade;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CidadeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

     /** @test */
    //CT_001.9 - Se retornar true o RG já está cadastrado no sistema;
    public function Unique(){
        $this->assertTrue(Cidade::cidadeCadastrada("Rio Branco", 1));
    }
}
