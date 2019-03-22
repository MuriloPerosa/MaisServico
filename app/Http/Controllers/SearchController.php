<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use App\Cidade;
use App\Categoria;
use App\Oferta;
use App\Necessidade;

class SearchController extends Controller
{
    public function index()
    {
        $cidades = Cidade::getCidadesCadastradas_1();
        return view('search.index', ['cidades' => $cidades]);
    }



    public function result($cidade_id, $tipo_id, $categoria_id, $ordenacao_id)
    {

        $my_errors[] = array();
    

        //0 - Avaliações
        //1 - Data
        //2 - maior preço
        //3 - menor preço
        if ($ordenacao_id == 0) {
            $ordenacao = "Avaliações";
        } else if ($ordenacao_id == 1) {
            $ordenacao = "Data";
        } else if ($ordenacao_id == 2) {
            $ordenacao = "Maior Preço";
        } else if ($ordenacao_id == 3) {
            $ordenacao = "Menor Preço";
        } else {
            $cidades = Cidade::getCidadesCadastradas_1();
            $my_errors[] = "Selecione uma ordenação válida!";
            return redirect()->route('search.index', ['cidades' => $cidades])->withErrors($my_errors);
        }


        $ofertas = null;
        $necessidades = null;
        $hasResult = false;

        //0 - todos
        //1 - ofertas
        //2 - necessidades
        if ($tipo_id == 1) {
            //Chamada a função que realiza a consulta no banco de dados 
            $ofertas = Oferta::getByCategoriaCidade($cidade_id, $categoria_id, $ordenacao_id);
            if ($ofertas->count() > 0) {
                $hasResult = true;
            }
            $tipo = "Ofertas";

        } else if ($tipo_id == 2) {
            $tipo = "Necessidades";

            $necessidades = Necessidade::getByCategoriaCidade($cidade_id, $categoria_id, $ordenacao_id);

            if ($necessidades->count() > 0) {
                $hasResult = true;
            }

        } else {
            $cidades = Cidade::getCidadesCadastradas_1();
            $my_errors[] = "Selecione um tipo válido!";
            return redirect()->route('search.index', ['cidades' => $cidades])->withErrors($my_errors);
        }



        return view('search.result', [
            'ofertas' => $ofertas, 'cidade' => Cidade::Find($cidade_id),
            'categoria' => Categoria::Find($categoria_id), 'tipo' => $tipo, 'ordenacao' => $ordenacao, 'necessidades' => $necessidades, 'hasResult' => $hasResult
        ]);
    }
}
