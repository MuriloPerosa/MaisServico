<?php

namespace App\Http\Controllers;

use App\Cidade;
use App\Estado;
use App\Http\Requests\CidadeRequest;
use App\Pessoa;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CidadesController extends Controller
{
    public function index(Request $filtro)
    {

        $filtragem = $filtro->get('filtragem');

        if ($filtragem == null) {
            $cidades = Cidade::orderBy('nome')->paginate(10);
        } else {
            $cidades = Cidade::where('nome', 'like', '%' . $filtragem . '%')->orderBy('nome')->paginate(10);
        }

        return view('cidades.index', ['cidades' => $cidades]);
    }

    public function create()
    {
        $estados = Estado::all()->pluck('nome', 'id');
        $user = Auth::user();
        $pessoa = $user->pessoa;
        return view('cidades.create', ['estados' => $estados, 'pessoa' => $pessoa]);
    }

    public function edit($id)
    {
        $cidade = Cidade::find($id);
        $estados = Estado::all()->pluck('nome', 'id');
        if ($cidade) {
            return view('cidades.edit', ['cidade' => $cidade, 'estados' => $estados]);
        }
        return redirect('/home');
    }


    public function update(CidadeRequest $request, $id)
    {
        $cidade = Cidade::find($id);
        if ($cidade) {
            $cidade->update($request->all());
            return redirect()->route('cidades');
        }

        return redirect('/home');
    }

    public function store(CidadeRequest $request)
    {
        $nova_cidade = $request->all();
        $cidade = Cidade::where('cidades.nome', $request->input('nome'))->where('cidades.estado_id', $request->input('estado_id'))->get();

        $user = Auth::user();
        $estados = Estado::pluck('nome', 'id');
        if (Cidade::cidadeCadastrada($request->input('nome'), $request->input('estado_id'))) {
            $my_errors = ['Falha ao cadastrar! Cidade já cadastrada.'];
            $pessoa = $user->pessoa;
            return view('cidades.create', ['estados' => $estados, 'pessoa' => $pessoa])->withErrors($my_errors);
        } else {
            Cidade::create($nova_cidade);
            $pessoa = $user->pessoa;
            if ($pessoa) {
                if ($pessoa->cidade_id == 0) {

                    $cidade = Cidade::getByNomeEstado($request->input('nome'), $request->input('estado_id'));
                    $pessoa->cidade_id = $cidade->id;
                    $pessoa->save();
                }
            }

            return redirect('/home');
        }
    }

    public function destroy($id)
    {

        try {
            Cidade::find($id)->delete();
            $ret = array('status' => 'ok', 'msg' => "null");
        } catch (\Illuminate\Database\Illuminate\Database\QueryException $e) {
            $ret = array('status' => 'erro', 'msg' => $e->getMessage());
        } catch (\PDOException $e) {
            $ret = array('status' => 'erro', 'msg' => $e->getMessage());
        }

        return $ret;
    }

    public function byEstado($id_estado)
    {
        $cidades = Cidade::where('estado_id', $id_estado)->where('id', '!=', 0)->get();
        return $cidades;
    }

}
