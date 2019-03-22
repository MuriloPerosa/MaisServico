<?php

namespace App\Http\Controllers;

use App\Cidade;
use App\Estado;
use App\Http\Requests\DeleteAccountRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\PessoaRequest;
use App\Pessoa;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function edit()
    {
        $user = Auth::user();
        $estados = Estado::where('id', '!=', 0)->orderBy('nome')->get();
        $pessoa = $user->pessoa;

        if ($pessoa == null) {
            $pessoa = new Pessoa();
        }

        $cidade = Cidade::where('id', $pessoa->cidade_id)->first();

        if ($cidade != null) {
            $cidades = Cidade::where('estado_id', $cidade->estado_id)->orderBy('nome')->get();

        } else {
            $cidades = Cidade::getCidadesCadastradas_1();
        }

        return view('user.edit', ['estados' => $estados, 'user' => $user, 'pessoa' => $pessoa, 'cidades' => $cidades, 'cidade' => $cidade]);
    }

    public function password()
    {
        return view('user.password');
    }

    public function update(PessoaRequest $request)
    {
        $user = Auth::user();
        $pessoa = new Pessoa();
        $oldPessoa = Pessoa::where('pessoas.user_id', $user->id)->get();

        $my_errors = array();
        $valido = true;

        if ($oldPessoa->count() > 0) {

            if (Pessoa::validarCPF($request->input('cpf')) == false) {
                $valido = false;
                $my_errors[] = "Falha ao alterar! O CPF informado não é válido!";
            }

            if (Pessoa::validarDataNascimento($request->input('data_nascimento')) == false) {
                $valido = false;
                $my_errors[] = "Falha ao alterar! O usuário deve ser maior de idade!";
            }

            if (strcasecmp($oldPessoa[0]->cpf, $request->input('cpf')) != 0) {

                if (Pessoa::cpfCadastrado($request->input('cpf'))) {
                    $valido = false;
                    $my_errors[] = "Falha ao alterar! O CPF já está cadastrado!";
                }
            }

            if (strcasecmp($oldPessoa[0]->rg, $request->input('rg')) != 0) {
                if (Pessoa::rgCadastrado($request->input('rg'))) {
                    $valido = false;
                    $my_errors[] = "Falha ao alterar! O RG já está cadastrado!";
                }
            }
        } else {

            if (Pessoa::validarCPF($request->input('cpf')) == false) {
                $valido = false;
                $my_errors[] = "Falha ao cadastrar! O CPF informado não é válido!";
            }

            if (Pessoa::validarDataNascimento($request->input('data_nascimento')) == false) {
                $valido = false;
                $my_errors[] = "Falha ao cadastrar! O usuário deve ser maior de idade!";
            }

            if (Pessoa::cpfCadastrado($request->input('cpf'))) {
                $valido = false;
                $my_errors[] = "Falha ao cadastrar! O CPF já está cadastrado!";
            }

            if (Pessoa::rgCadastrado($request->input('rg'))) {
                $valido = false;
                $my_errors[] = "Falha ao cadastrar! O RG já está cadastrado!";
            }
        }

        $estados = Estado::where('id', '!=', 0)->orderBy('nome')->get();
        $cidades = Cidade::getCidadesCadastradas_1();
        $cidade = Cidade::Find($request->input('cidade_id'));
        if ($valido == false) {

            return redirect()->route('user.edit', ['estados' => $estados, 'cidade' => $cidade, 'user' => $user, 'pessoa' => $user->pessoa, 'cidades' => $cidades])->withErrors($my_errors);
        } else {

            $newPessoa = new Pessoa();
            //colocar valores na nova pessoa

            if ($oldPessoa->count() == 0) {
                //cadastrar nova pessoa
                $newPessoa->cpf = $request->input('cpf');
                $newPessoa->rg = $request->input('rg');
                $newPessoa->telefone = $request->input('telefone');
                $newPessoa->celular = $request->input('celular');
                $newPessoa->data_nascimento = $request->input('data_nascimento');
                $newPessoa->cidade_id = $request->input('cidade_id');
                $newPessoa->user_id = $user->id;

                //$nova_pessoa = $request->all();
                //Pessoa::create($newPessoa);

                $newPessoa->save();

                if ($newPessoa->cidade_id == 0) {
                    return redirect()->route('cidades.create');
                } else {
                    return redirect('/home');
                }

            } else {

                //alterar velha pessoa

                $oldPessoa[0]->cpf = $request->input('cpf');

                $oldPessoa[0]->rg = $request->input('rg');

                $oldPessoa[0]->telefone = $request->input('telefone');
                $oldPessoa[0]->celular = $request->input('celular');
                $oldPessoa[0]->data_nascimento = $request->input('data_nascimento');
                $oldPessoa[0]->cidade_id = $request->input('cidade_id');
                $oldPessoa[0]->user_id = $user->id;
                $oldPessoa[0]->save();
            }

            //retornar uma view que preste
            return redirect('home');
        }
    }

    public function updatepassword(PasswordRequest $request)
    {
        $my_errors = array();
        $valido = true;

        $user = Auth::user();

        if ($user->validarSenha($request->input('password')) == false) {
            $valido = false;
            $my_errors[] = "Falha ao alterar! A senha está incorreta!";
        }

        if (strcmp($request->input('newPassword'), $request->input('confirmPassword')) != 0) {
            $valido = false;
            $my_errors[] = "Falha ao alterar! A nova senha e a confirmação são diferentes!";
        }

        if ($valido) {
            $user->password = bcrypt($request->input('newPassword'));
            $user->save();
            $user = Auth::user();
            $estados = Estado::pluck('nome', 'id');
            $pessoa = $user->pessoa;
            return redirect('home');
        } else {
            return view('user.password')->withErrors($my_errors);
        }
    }

    public function confirmarexclusao()
    {
        return view('user.confirmarexclusao');
    }

    public function delete(DeleteAccountRequest $request)
    {
        $my_errors = array();
        $valido = true;

        $user = Auth::user();

        if ($user->validarSenha($request->input('password')) == false) {
            $valido = false;
            $my_errors[] = "Falha ao excluir! A senha está incorreta!";
        }

        if ($valido) {
            $user->delete();
            return redirect('login');
        } else {
            return view('user.confirmarexclusao')->withErrors($my_errors);
        }

    }
    public function redefinirsenha()
    {
        return view('user.redefinirsenha');
    }

}
