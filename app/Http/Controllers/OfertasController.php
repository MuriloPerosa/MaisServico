<?php

namespace App\Http\Controllers;

use App\Cidade;
use App\Http\Requests\OfertaRequest;
use Illuminate\Http\Request;
use App\Oferta;
use App\User;
use App\Pessoa;
use Illuminate\Support\Facades\Auth;

class OfertasController extends Controller
{
    public function index(Request $filtro)
    {
        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }


        $filtragem = $filtro->get('filtragem');

        if ($filtragem == null) {
            $ofertas = Oferta::where('user_id', Auth::user()->id)->orderBy('titulo')->paginate(10);
        } else {
            $ofertas = Oferta::where('user_id', Auth::user()->id)->where('titulo', 'like', '%' . $filtragem . '%')->orderBy('titulo')->paginate(10);
        }

        return view('ofertas.index', ['ofertas' => $ofertas]);
    }

    public function create()
    {
        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        $cidades = Cidade::getCidadesCadastradas_1();
        $pessoa = Auth::user()->pessoa;
        return view('ofertas.create', ['cidades' => $cidades, 'pessoa' => $pessoa]);
    }

    public function store(OfertaRequest $request)
    {

        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        $nova_oferta = $request->all();
        Oferta::create($nova_oferta);
        return redirect()->route('ofertas')->with('success', 'Oferta cadastrada com sucesso!');
    }

    public function active($id)
    {

        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }
        $oferta = Oferta::find($id);

        if ($oferta) {

            if (Auth::user()->id == $oferta->user_id) {
                if ($oferta->ativo) {
                    $oferta->ativo = false;
                    $oferta->save();
                    return redirect()->route('ofertas')->with('success', 'Oferta desativada com sucesso!');
                } else {
                    $oferta->ativo = true;
                    $oferta->save();
                    return redirect()->route('ofertas')->with('success', 'Oferta ativada com sucesso!');
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

        $oferta = Oferta::find($id);

        if (Auth::user()->id == $oferta->user_id) {

            try {
                $oferta->delete();
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

        $oferta = Oferta::find($id);
        if ($oferta) {
            $cidades = Cidade::where('estado_id', $oferta->cidade->estado_id)->where('id', '!=', 0)->get();
            return view('ofertas.edit', ['cidades' => $cidades, 'oferta' => $oferta]);
        }
        return redirect('/home');
    }

    public function update(OfertaRequest $request, $id)
    {
        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        Oferta::find($id)->update($request->all());
        return redirect()->route('ofertas')->with('success', 'Oferta editada com sucesso!');
    }

    public function info($id)
    {
        $oferta = Oferta::find($id);
        if ($oferta->ativo) {
            return view('ofertas.info', ['oferta' => $oferta]);
        }
        return redirect('/home');
    }
}
