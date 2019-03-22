<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoriaRelatorioRequest;
use App\Http\Requests\LocalizacaoRelatorioRequest;
use App\Http\Requests\ServicosAnoRelatorioRequest;
use App\Cidade;

class RelatoriosController extends Controller
{
    public function categoria()
    {
        return view('relatorios.categoria');
    }

    public function localizacao()
    {
        $cidades = Cidade::getCidadesCadastradas_1();
        return view('relatorios.localizacao', ['cidades' => $cidades]);
    }

    public function servicosAno()
    {
        return view('relatorios.servicosAno');
    }


    public function categoriaPost(CategoriaRelatorioRequest $request)
    {

        return redirect('/pdf/' . $request->get('categoria_id') . '/categoria');
    }

    public function localizacaoPost(LocalizacaoRelatorioRequest $request)
    {

        return redirect('/pdf/' . $request->get('cidade_id') . '/localizacao');
    }

    public function servicosAnoPost(ServicosAnoRelatorioRequest $request)
    {

        return redirect('/pdf/' . $request->get('ano') . '/servicos');
    }
}
