<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{

    //Retorna todas as ofertas da categoria
    public function cidades()
    {
        return $this->hasMany('App\Cidade');
    }
}
