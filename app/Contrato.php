<?php

namespace App;

use App\Oferta;
use App\Contrato;
use App\User;
use Illuminate\Support\Facades\Auth;
use \Datetime;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $fillable = [
        'endereco', 'observacoes', 'data_assinatura', 'data_realizado', 'data_gerado', 'avaliacao_cmt',
        'avaliacao_nota', 'cidade_id', 'oferta_id', 'contratante_id', 'data_inicio', 'data_fim', 'em_andamento', 'preco'
    ];

    protected $attributes = [
        'em_andamento' => true,
    ];


     //retorna a oferta do contrato
    public function oferta()
    {
        return $this->belongsTo('App\Oferta');
    }


    //retorna a cidade do contrato
    public function cidade()
    {
        return $this->belongsTo('App\Cidade');
    }

    //retorna o usuário contratante
    public function contratante()
    {
        return User::find($this->contratante_id)->first();
    }

    //retorna a data de inicio no padrão de exibição em formulários
    public function dataInicioForms()
    {
        $dateTime = new DateTime($this->data_inicio);
        $date = $dateTime->format('Y-m-d');
        $time = $dateTime->format('H:i:s');
        return $date . "T" . $time;
    }

    //retorna a data de fim no padrão de exibição em formulários
    public function dataFimForms()
    {
        $dateTime = new DateTime($this->data_fim);
        $date = $dateTime->format('Y-m-d');
        $time = $dateTime->format('H:i:s');
        return $date . "T" . $time;
    }

    //Retorna os contratos em andamento em que o usuário é o contratante
    public static function getAllEmAndamentoByContratanteId($id)
    {
        $contratante = Contrato::where('contratante_id', $id)->where('em_andamento', true)->orderBy('id', 'desc')->paginate(10);
        return $contratante;
    }

    //Retorna os contratos em andamento em que o usuário é o contratado
    public static function getAllEmAndamentoByContratadoId($id)
    {
        $contratado = Oferta::join('contratos', 'contratos.oferta_id', '=', 'ofertas.id')
            ->where('ofertas.user_id', $id)->where('contratos.em_andamento', true)
            ->orderBy('contratos.id', 'desc')->select('contratos.id', 'ofertas.titulo', 'contratos.data_gerado', 'contratos.created_at')->paginate(10);
        return $contratado;
    }

    //Retorna os contratos finalizados em que o usuário é o contratado
    public static function getAllFinalizadosByContratadoId($id)
    {
        $contratado = Oferta::join('contratos', 'contratos.oferta_id', '=', 'ofertas.id')
            ->where('ofertas.user_id', $id)->where('contratos.em_andamento', false)
            ->orderBy('contratos.id', 'desc')->select('contratos.id', 'ofertas.titulo', 'contratos.data_gerado', 'contratos.created_at', 'contratos.data_realizado', 'contratos.avaliacao_nota')->paginate(10);
        return $contratado;
    }

    //Retorna os contratos finalizados em que o usuário é o contratante
    public static function getAllFinalizadosByContratanteId($id)
    {
        $contratante = Contrato::where('contratante_id', $id)->where('em_andamento', false)->orderBy('id', 'desc')->paginate(10);
        return $contratante;
    }
    

    //Pega retorna o contrato ainda não gerado do usuário e a oferta.
    public static function getByUserOferta_NotGerado($user, $oferta)
    {
        return Contrato::where('contratante_id', $user->id)->where('oferta_id', $oferta->id)->where('em_andamento', true)->first();
    }


        //Retorna os dados de contrato realizados em que o usuário é o contratado por mes
    public static function contratosRealizadosMes($id)
    {
        $retorno = Oferta::join('contratos', 'contratos.oferta_id', '=', 'ofertas.id')
            ->where('ofertas.user_id', $id)->where('contratos.em_andamento', false)->where('contratos.data_realizado', '!=', null)
            ->orderBy('contratos.data_realizado')->selectRaw('sum(contratos.preco) as valor, count(contratos.id) as cont, YEAR(data_realizado) as ano, MONTH(data_realizado) as mes')
            ->groupby('ano', 'mes')->get();
        return $retorno;
    }

    //Retorna os dados de contrato realizados em que o usuário é o contratado por ano
    public static function contratosRealizadosAno($id)
    {
        $retorno = Oferta::join('contratos', 'contratos.oferta_id', '=', 'ofertas.id')
            ->where('ofertas.user_id', $id)->where('contratos.em_andamento', false)->where('contratos.data_realizado', '!=', null)
            ->orderBy('contratos.data_realizado')->selectRaw('sum(contratos.preco) as valor, count(contratos.id) as cont, YEAR(data_realizado) as ano')
            ->groupby('ano')->get();
        return $retorno;
    }
}
