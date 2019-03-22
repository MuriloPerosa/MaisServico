<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cidade;
use App\Oferta;
use App\Categoria;
use App\User;

class Oferta extends Model
{
    protected $fillable = [
        'titulo', 'descricao', 'observacoes', 'email',
        'telefone', 'preco', 'unidade', 'ativo', 'celular', 'cidade_id', 'categoria_id', 'user_id', 'media_notas'
    ];


    protected $attributes = [
        'ativo' => true,
    ];

   //retorna o usuário dono da oferta
    public function user()
    {
        // return User::find($this->user_id);
        return $this->belongsTo('App\User');
    }

   //retorna a categoria da oferta
    public function categoria()
    {
        return $this->belongsTo('App\Categoria');
    }

    //retorna a cidade da oferta
    public function cidade()
    {
        return $this->belongsTo('App\Cidade');
    }

    public static function getByCategoriaCidade($cidade, $categoria, $ordenacao)
    {

        $retorno = null;

        if ($ordenacao == 0) {
            $retorno = Oferta::where('cidade_id', $cidade)->where('categoria_id', $categoria)->where('ativo', true)->orderBY('media_notas', 'DESC')->paginate(10);
        } else if ($ordenacao == 1) {
            $retorno = Oferta::where('cidade_id', $cidade)->where('categoria_id', $categoria)->where('ativo', true)->orderBY('created_at', 'DESC')->paginate(10);
        } else if ($ordenacao == 2) {
            $retorno = Oferta::where('cidade_id', $cidade)->where('categoria_id', $categoria)->where('ativo', true)->orderBY('preco', 'DESC')->paginate(10);
        } else if ($ordenacao == 3) {
            $retorno = Oferta::where('cidade_id', $cidade)->where('categoria_id', $categoria)->where('ativo', true)->orderBY('preco')->paginate(10);
        }

        return $retorno;
    }


    public static function getRecomendacoes($cidade)
    {

        $retorno = null;
        $retorno = Oferta::where('cidade_id', $cidade)->where('ativo', true)->orderBy('media_notas', 'DESC')->paginate(5);

        if ($retorno->count() < 5) {
            $qtd = 5 - $retorno->count();

            $complemento = Oferta::orderBy('media_notas', 'DESC')->paginate($qtd);

            $retorno = $retorno->merge($complemento);
        }

        return $retorno;
    }
    //Retorna todas os contratos da oferta
    public function contratos()
    {
        return $this->hasMany('App\Contrato');
    }

    //Retorna a média de notas da oferta
    public function getMedia()
    {
        $nota = 0;

        foreach ($this->contratosAvaliados() as $c) {
            $nota = $nota + $c->avaliacao_nota;
        }



        if ($nota > 0) {

            return $nota / count($this->contratosAvaliados());
        } else {
            return 0;
        }
    }

    //Retorna apenas os contratos avaliados
    public function contratosAvaliados()
    {
        $contratos = array();
        foreach ($this->contratos as $c) {
            if ($c->avaliacao_nota) {
                $contratos[] = $c;
            }
        }
        return $contratos;
    }


}
