<?php

namespace App\Http\Controllers;

use Mail;
use App\Oferta;
use App\Contrato;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ContratoRequest;
use App\Http\Requests\AvaliacaoRequest;
use \Datetime;

class ContratosController extends Controller
{
    public function index()
    {
        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        $em_andamento_contratante = Contrato::getAllEmAndamentoByContratanteId(Auth::user()->id);
        $em_andamento_contratado = Contrato::getAllEmAndamentoByContratadoId(Auth::user()->id);
        $finalizados_contratou = Contrato::getAllFinalizadosByContratanteId(Auth::user()->id);
        $finalizados_contratado = Contrato::getAllFinalizadosByContratadoId(Auth::user()->id);
        return view('contratos.index', [
            'em_andamento_contratante' => $em_andamento_contratante,
            'em_andamento_contratado' => $em_andamento_contratado, 'finalizados_contratou' => $finalizados_contratou, 'finalizados_contratado' => $finalizados_contratado
        ]);
    }

    public function fill($id)
    {
        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        $oferta = Oferta::Find($id);
        if ($oferta && $oferta->ativo) {
            $contrato = Contrato::getByUserOferta_NotGerado(Auth::user(), $oferta);

            if ($contrato === null) {
                $contrato = new Contrato();
                $contrato->cidade_id = $oferta->cidade->id;
                $contrato->oferta_id = $oferta->id;
                $contrato->contratante_id = Auth::user()->id;

                $contrato->save();
            }
            return redirect()->route('contratos.edit', ['id' => $contrato->id]);
        }
        return redirect('/home');
    }

    public function edit($id)
    {


        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        $contrato = Contrato::Find($id);


        if ($contrato) {

            $preenchido = true;
            if ($contrato->endereco == false) {
                $preenchido = false;
            } else if ($contrato->data_inicio == false) {
                $preenchido = false;
            } else if ($contrato->data_fim == false) {
                $preenchido = false;
            } else if ($contrato->preco == false) {
                $preenchido = false;
            }

            if ($contrato->data_gerado) {
                return redirect()->route('contratos.info', ['id' => $contrato->id]);
            }
            return view('contratos.fill', ['contrato' => $contrato, 'user' => Auth::user(), 'preenchido' => $preenchido]);
        }
        return redirect('/home');
    }

    public function save(ContratoRequest $request, $id)
    {

        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        $contrato = Contrato::find($id);
        $contrato->update($request->all());

        if (Auth::user()->id === $contrato->contratante_id) {
            //enviar para o contratado
            $contratante = User::Find($contrato->contratante_id);
            $data = array('name' => $contrato->oferta->user->name, "user" => $contratante->name, "link" => $_SERVER['HTTP_REFERER']);

            Mail::send('emails.definicaoContrato', $data, function ($message) use ($contrato) {
                $message->to($contrato->oferta->user->email, $contrato->oferta->user->name)
                    ->subject('+Serviço - MUDANÇAS NAS DEFINIÇÕES DE CONTRATOS');
                $message->from('maisservicoprojeto@gmail.com', '+Serviço');
            });

        } else {
            //enviar para o contratante
            $contratante = User::Find($contrato->contratante_id);
            $data = array('name' => $contratante->name, "user" => $contrato->oferta->user->name, "link" => $_SERVER['HTTP_REFERER']);

            Mail::send('emails.definicaoContrato', $data, function ($message) use ($contratante) {
                $message->to($contratante->email, $contratante->name)
                    ->subject('+Serviço - MUDANÇAS NAS DEFINIÇÕES DE CONTRATOS');
                $message->from('maisservicoprojeto@gmail.com', '+Serviço');
            });
        }




        return redirect()->route(
            'contratos.edit',
            ['id' => $contrato->id]
        )->with('success', 'Definições de contrato alteradas com sucesso!');
    }


    public function generate($id)
    {

        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        $valido = true;

        $contrato = Contrato::Find($id);
        if ($contrato) {

            if ($contrato->endereco == false) {
                $valido = false;
            } else if ($contrato->data_inicio == false) {
                $valido = false;
            } else if ($contrato->data_fim == false) {
                $valido = false;
            } else if ($contrato->preco == false) {
                $valido = false;
            }

            if ($valido) {

                $dateTime = new DateTime();
                $date = $dateTime->format('Y-m-d H:i:s');
        
        // $contrato->data_gerado = date("Y-m-d H:i:s");
                $contrato->data_gerado = $date;
                $contrato->save();


                $contratante = User::Find($contrato->contratante_id);
                $data = array('name' => $contratante->name, "user" => $contrato->oferta->user->name, "link" => $_SERVER['HTTP_HOST'] . "/contratos/" . $contrato->id . "/info");

                Mail::send('emails.contratoGerado', $data, function ($message) use ($contratante) {
                    $message->to($contratante->email, $contratante->name)
                        ->subject('+Serviço - MUDANÇAS NAS DEFINIÇÕES DE CONTRATOS');
                    $message->from('maisservicoprojeto@gmail.com', '+Serviço');
                });


                return redirect()->route(
                    'contratos.edit',
                    ['id' => $contrato->id]
                )->with('success', 'Definições de contrato alteradas com sucesso!');
            } else {

                $errors = "Erro! Para gerar o contrato primeiro ele deve ser completamente preenchido!";


                return redirect()->route(
                    'contratos.edit',
                    ['id' => $contrato->id]
                )->with('g_errors', $errors);
            }
        }
        return redirect('/home');
    }

    public function info($id)
    {
        $contrato = Contrato::Find($id);

        if ($contrato) {

            $contratante = User::Find($contrato->contratante_id);
            if ($contrato->data_gerado == null) {
                return redirect()->route('contratos.edit', ['id' => $contrato->id]);
            }
            return view('contratos.info', ['contrato' => $contrato, 'contratante' => $contratante]);
        }

        return redirect('/home');
    }

    public function sign($id)
    {

        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        $contrato = Contrato::Find($id);

        if ($contrato) {

            $contratante = User::Find($contrato->contratante_id);
            if ($contrato->data_gerado == null) {
                return redirect()->route('contratos.edit', ['id' => $contrato->id]);
            }
            $dateTime = new DateTime();
            $date = $dateTime->format('Y-m-d H:i:s');
            $contrato->data_assinatura = $date;
            $contrato->em_andamento = false;
            $contrato->save();

            //e-mail de contrato assinado
            $data = array('name' => $contrato->oferta->user->name, "user" => $contratante->name, "link" => $_SERVER['HTTP_HOST'] . "/contratos/" . $contrato->id . "/info");

            Mail::send('emails.contratoAssinado', $data, function ($message) use ($contrato) {
                $message->to($contrato->oferta->user->email, $contrato->oferta->user->name)
                    ->subject('+Serviço - CONTRATO ASSINADO!');
                $message->from('maisservicoprojeto@gmail.com', '+Serviço');
            });



            return redirect()->route('contratos.info', ['contrato' => $contrato])->with('success', 'Feito! O contrato foi assinado!');
        }

        return redirect('/home');
    }

    public function redo($id)
    {
        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        $contrato = Contrato::Find($id);

        if ($contrato) {
            $contratante = User::Find($contrato->contratante_id);

            if ($contrato->data_gerado == null) {
                return redirect()->route('contratos.edit', ['id' => $contrato->id]);
            } else if ($contrato->data_assinatura) {
                return redirect('/home');
            }

            $contrato->data_gerado = null;
            $contrato->em_andamento = true;
            $contrato->save();

            //e-mail de contrato assinado
            $data = array('name' => $contrato->oferta->user->name, "user" => $contratante->name, "link" => $_SERVER['HTTP_HOST'] . "/contratos/" . $contrato->id . "/edit");

            Mail::send('emails.contratoRecusado', $data, function ($message) use ($contrato) {
                $message->to($contrato->oferta->user->email, $contrato->oferta->user->name)
                    ->subject('+Serviço - CONTRATO RECUSADO!');
                $message->from('maisservicoprojeto@gmail.com', '+Serviço');
            });

            return redirect()->route('contratos.edit', ['id' => $contrato->id]);
        }

        return redirect('/home');
    }

    public function done($id)
    {

        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        $contrato = Contrato::Find($id);

        if ($contrato) {
            if ($contrato->oferta->user->id == Auth::user()->id) {
                if ($contrato->data_realizado == null) {
                    $dateTime = new DateTime();
                    $date = $dateTime->format('Y-m-d H:i:s');
                    $contrato->data_realizado = $date;
                    $contrato->save();
                    return redirect('contratos');
                }
            }
        }
        return redirect('/home');
    }

    public function score($id)
    {
        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        $contrato = Contrato::Find($id);
        if ($contrato) {
            if ($contrato->contratante_id == Auth::user()->id) {
                if ($contrato->data_realizado != null) {
                    if ($contrato->avaliacao_nota == null) {
                        return view('contratos.score', ['contrato' => $contrato]);
                    }
                }
            }
        }
        return redirect('/home');
    }

    public function setscore(AvaliacaoRequest $request, $id)
    {
        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        $contrato = Contrato::Find($id);
        if ($contrato) {
            if ($contrato->contratante_id == Auth::user()->id) {
                if ($contrato->data_realizado != null) {
                    if ($contrato->avaliacao_nota == null) {
                        $contrato->avaliacao_nota = $request->input('avaliacao_nota');
                        $contrato->avaliacao_cmt = $request->input('avaliacao_cmt');
                        $contrato->save();

                        $contrato = Contrato::Find($id);
                        $contrato->oferta->media_notas = $contrato->oferta->getMedia();
                        $contrato->oferta->save();
                        return redirect('/contratos');
                    }
                }
            }
        }
        return redirect('/home');
    }
}
