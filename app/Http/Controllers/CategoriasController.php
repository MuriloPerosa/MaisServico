<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use App\CategoriaPalavras;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CategoriaRequest;


class CategoriasController extends Controller
{

    public function index(Request $filtro)
    {
        if ($this->allowedUser()) {

            $filtragem = $filtro->get('filtragem');

            if ($filtragem == null) {
                $categorias = Categoria::orderBy('nome')->paginate(10);
            } else {
                $categorias = Categoria::where('nome', 'like', '%' . $filtragem . '%')->orderBy('nome')->paginate(10);
            }

            return view('categorias.index', ['categorias' => $categorias]);
        }
        return redirect('/home');
    }


    public function destroy($id)
    {

        if ($this->allowedUser()) {

            try {
                CategoriaPalavras::where('categoria_id', '=', $id)->delete();
                Categoria::find($id)->delete();
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

    public function update(CategoriaRequest $request, $id)
    {
        if ($this->allowedUser()) {
            $categoria = Categoria::find($id);
            if ($categoria) {

                $categoria->update([
                    'nome' => $request->get('nome'),
                    'descricao' => $request->get('descricao')
                ]);

                foreach ($categoria->categoria_palavras as $cp) {
                    $cp->delete();
                }

                $itens = $request->itens;
                if ($itens) {

                    foreach ($itens as $key => $value) {
                        CategoriaPalavras::create([
                            'categoria_id' => $categoria->id,
                            'palavra_id' => $itens[$key]
                        ]);
                    }
                }

                return redirect()->route('categorias')->with('success', 'Categoria "' . $request->input('nome') . '" atualizada com sucesso!');
            }
        }
        return redirect('/home');
    }

    public function createmaster()
    {
        if ($this->allowedUser()) {
            return view('categorias.masterdetail');
        }
        return view('/home');
    }

    public function edit($id)
    {
        if ($this->allowedUser()) {
            $categoria = Categoria::find($id);
            if ($categoria) {
                return view('categorias.edit', ['categoria' => $categoria]);
            }
        }
        return view('/home');
    }

    public function masterdetail(Request $request)
    {
        if ($this->allowedUser()) {

            $categoria = Categoria::create([
                'nome' => $request->get('nome'),
                'descricao' => $request->get('descricao')
            ]);
            $itens = $request->itens;
            if ($itens) {

                foreach ($itens as $key => $value) {
                    CategoriaPalavras::create([
                        'categoria_id' => $categoria->id,
                        'palavra_id' => $itens[$key]
                    ]);
                }
            }
            return redirect()->route('categorias');
        }
        return view('/home');
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
