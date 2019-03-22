<?php

namespace App;

use App\Categoria;
use App\Cidade;

use Illuminate\Database\Eloquent\Model;

class Necessidade extends Model
{
    protected $fillable = ['titulo', 'descricao', 'observacoes', 'email', 'telefone', 'data_limite', 'ativo', 'celular', 'cidade_id', 'categoria_id', 'user_id'];


    protected $attributes = [
        'ativo' => true,
    ];

   //retorna o usuário dono da oferta
    public function user()
    {
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

        if ($ordenacao == 0 || $ordenacao == 2 || $ordenacao == 3) {
            $retorno = Necessidade::where('cidade_id', $cidade)->where('categoria_id', $categoria)->where('ativo', true)->paginate(10);
        } else if ($ordenacao == 1) {
            $retorno = Necessidade::where('cidade_id', $cidade)->where('categoria_id', $categoria)->where('ativo', true)->orderBY('created_at', 'DESC')->paginate(10);
        }

        return $retorno;
    }


    public static function getRecomendacoes($cidade)
    {

        $retorno = null;
        $retorno = Necessidade::where('cidade_id', $cidade)->where('ativo', true)->orderBy('created_at', 'DESC')->paginate(5);

        if ($retorno->count() < 5) {
            $qtd = 5 - $retorno->count();

            $complemento = Necessidade::orderBy('created_at', 'DESC')->paginate($qtd);

            $retorno = $retorno->merge($complemento);
        }

        return $retorno;
    }
}
