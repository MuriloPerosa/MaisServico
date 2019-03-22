<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Http\Requests\InteresseRequest;
use App\Pessoa;
use App\User;
use App\Oferta;
use App\Necessidade;
use App\Interesse;
use Illuminate\Support\Facades\Auth;

class InteressesController extends Controller
{
    public function index()
    {
        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        $propostas = Interesse::getAllFinalizadosByNecessidadeUserId(Auth::user()->id);
        $interesses = Interesse::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('interesses.index', ['propostas' => $propostas, "interesses" => $interesses]);
    }

    public function create($id)
    {

        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        $necessidade = Necessidade::find($id);

        if ($necessidade) {
            $pessoa = Auth::user()->pessoa;
            $ofertas = Oferta::where('user_id', $pessoa->user->id)->orderBy('created_at', 'desc')->paginate(10);
            return view('interesses.create', ['pessoa' => $pessoa, 'ofertas' => $ofertas, 'necessidade' => $necessidade]);
        }
        return redirect('/home');
    }

    public function store(InteresseRequest $request, $id)
    {
        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        $necessidade = Necessidade::find($id);

        if ($necessidade) {
            $interesse = new Interesse();
            $interesse->email = $request->get('email');
            $interesse->telefone = $request->get('telefone');
            $interesse->celular = $request->get('celular');
            $interesse->ativo = true;
            $interesse->orcamento = $request->get('orcamento');
            $interesse->oferta_id = $request->get('oferta_id');
            $interesse->necessidade_id = $necessidade->id;
            $interesse->user_id = Auth::user()->id;

            $interesse->save();

            $data = array('name' => $interesse->oferta->user->name, "user" => $interesse->user->name, "link" => $_SERVER['HTTP_HOST'] . "/interesses/" . $interesse->id . "/info");

            Mail::send('emails.interesseInformado', $data, function ($message) use ($interesse) {
                $message->to($interesse->oferta->user->email, $interesse->oferta->user->name)
                    ->subject('+Serviço - INTERESSE MANIFESTADO');
                $message->from('maisservicoprojeto@gmail.com', '+Serviço');
            });


            return redirect('/interesses');
        }
        return redirect('/home');
    }

    public function info($id)
    {
        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        $interesse = Interesse::find($id);

        if ($interesse) {
            return view('interesses.info', ['interesse' => $interesse]);
        }
        return redirect('/home');
    }
}
