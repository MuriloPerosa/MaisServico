<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Necessidade;

class Interesse extends Model
{
    protected $fillable = [
        'email', 'telefone', 'celular', 'orcamento', 'necessidade_id', 'oferta_id', 'user_id', 'ativo',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function necessidade()
    {
        return $this->belongsTo('App\Necessidade');
    }

    public function oferta()
    {
        return $this->belongsTo('App\Oferta');
    }


       //Retorna os interesses  em que o usuário é o criador da necessidade
    public static function getAllFinalizadosByNecessidadeUserId($id)
    {
        $retorno = Interesse::join('necessidades', 'necessidades.id', '=', 'interesses.necessidade_id')
            ->where('necessidades.user_id', $id)
            ->orderBy('interesses.created_at', 'desc')->select('interesses.id as id', 'interesses.created_at as data', 'interesses.id as interesse_id', 'necessidades.id as necessidade_id', 'interesses.oferta_id as oferta_id')->paginate(10);
        return $retorno;
    }
   
       //Retorna os contratos finalizados em que o usuário é o contratante
    public static function getAllFinalizadosContratanteId($id)
    {
        $contratante = Contrato::where('contratante_id', $id)->where('em_andamento', false)->orderBy('id', 'desc')->paginate(10);
        return $contratante;
    }
}
