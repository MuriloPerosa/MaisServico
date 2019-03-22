<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pessoa;
use App\PalavraChave;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PalavrasChaveRequest;


class PalavrasChaveController extends Controller
{
    public function index(Request $filtro)
    {
        if ($this->allowedUser()) {

            $filtragem = $filtro->get('filtragem');

            if ($filtragem == null) {
                $palavras = PalavraChave::orderBy('palavra')->paginate(10);
            } else {
                $palavras = PalavraChave::where('palavra', 'like', '%' . $filtragem . '%')->orderBy('palavra')->paginate(10);
            }

            return view('palavras.index', ['palavras' => $palavras]);
        }
        return redirect('/home');
    }

    public function create()
    {
        if ($this->allowedUser()) {
            return view('palavras.create');
        }
        return redirect('/home');
    }

    public function store(PalavrasChaveRequest $request)
    {

        if ($this->allowedUser()) {
            $nova_palavra = $request->all();
            PalavraChave::create($nova_palavra);
            return redirect()->route('palavras')->with('success', 'Nova palavra "' . $request->input('palavra') . '" cadastrada com sucesso!');
        }
        return redirect('/home');

    }

    public function destroy($id)
    {
        $palavra = PalavraChave::find($id);

        if ($this->allowedUser()) {

            try {
                $palavra->delete();
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
        if ($this->allowedUser()) {
            $palavra = PalavraChave::find($id);
            if ($palavra) {
                return view('palavras.edit', ['palavra' => $palavra]);
            }
        }
        return redirect('/home');
    }

    public function update(PalavrasChaveRequest $request, $id)
    {

        if ($this->allowedUser()) {
            $palavra = PalavraChave::find($id);
            if ($palavra) {
                $palavra->update($request->all());
                return redirect()->route('palavras')->with('success', 'Palavra editada com sucesso!');
            }
        }
        return redirect('/home');
    }

    //Verifica se o usuário logado é administrador
    public function allowedUser()
    {
        if (Auth::user()->administrador) {
            return true;
        }

        return false;
    }
}
