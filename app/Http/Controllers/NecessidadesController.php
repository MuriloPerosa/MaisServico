<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Cidade;
use App\Necessidade;
use App\Pessoa;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NecessidadeRequest;

class NecessidadesController extends Controller
{
    public function index(Request $filtro)
    {
        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        $filtragem = $filtro->get('filtragem');

        if ($filtragem == null) {
            $necessidades = Necessidade::where('user_id', Auth::user()->id)->orderBy('titulo')->paginate(10);
        } else {
            $necessidades = Necessidade::where('user_id', Auth::user()->id)->where('titulo', 'like', '%' . $filtragem . '%')->orderBy('titulo')->paginate(10);
        }
        return view('necessidades.index', ['necessidades' => $necessidades]);
    }

    public function create()
    {
        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        $cidades = Cidade::getCidadesCadastradas_1();
        $pessoa = Auth::user()->pessoa;
        return view('necessidades.create', ['cidades' => $cidades, 'pessoa' => $pessoa]);
    }

    public function store(NecessidadeRequest $request)
    {
        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        $nova_necessidade = $request->all();
        Necessidade::create($nova_necessidade);
        return redirect()->route('necessidades')->with('success', 'Necessidade cadastrada com sucesso!');
    }

    public function active($id)
    {

        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        $necessidade = Necessidade::find($id);

        if ($necessidade) {

            if (Auth::user()->id == $necessidade->user_id) {
                if ($necessidade->ativo) {
                    $necessidade->ativo = false;
                    $necessidade->save();
                    return redirect()->route('necessidades')->with('success', 'Necessidade desativada com sucesso!');
                } else {
                    $necessidade->ativo = true;
                    $necessidade->save();
                    return redirect()->route('necessidades')->with('success', 'Necessidade ativada com sucesso!');
                }
            }

            return redirect()->route('ofertas');
        }
        return redirect('/home');
    }

    public function destroy($id)
    {
        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        $necessidade = Necessidade::find($id);
        if (Auth::user()->id == $necessidade->user_id) {

            try {
                $necessidade->delete();
                $ret = array('status' => 'ok', 'msg' => "null");
            } catch (\Illuminate\Database\Illuminate\Database\QueryException $e) {
                $ret = array('status' => 'erro', 'msg' => $e->getMessage());
            } catch (\PDOException $e) {
                $ret = array('status' => 'erro', 'msg' => $e->getMessage());
            }
        } else {
            $ret = array('status' => 'erro', 'msg' => "Erro! Você não tem permissão para remover esta oferta!");
        }
        return $ret;
    }

    public function edit($id)
    {

        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        $necessidade = Necessidade::find($id);
        $cidades = Cidade::where('estado_id', $necessidade->cidade->estado_id)->where('id', '!=', 0)->get();
        return view('necessidades.edit', ['cidades' => $cidades, 'necessidade' => $necessidade]);
    }

    public function update(NecessidadeRequest $request, $id)
    {
        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        Necessidade::find($id)->update($request->all());
        return redirect()->route('necessidades')->with('success', 'Necessidade editada com sucesso!');
    }

    public function info($id)
    {
        $necessidade = Necessidade::find($id);
        if ($necessidade) {
            return view('necessidades.info', ['necessidade' => $necessidade]);
        } else {
            return redirect('/home');
        }
    }
}
