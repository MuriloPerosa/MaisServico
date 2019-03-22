<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nome', 'descricao'];


     //Retorna todas as ofertas da categoria
    public function ofertas()
    {
        return $this->hasMany('App\Oferta');
    }

    //Retorna todas as necessidades da categoria

    public function necessidades()
    {
        return $this->hasMany('App\Necessidade');
    }

    public function categoria_palavras()
    {
        return $this->hasMany('App\CategoriaPalavras');
    }
}
