<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Oferta;

class Cidade extends Model
{
    protected $fillable = ['nome', 'estado_id'];

    protected $attributes = [
        'cod_ibge' => 1111,
    ];


    //retorna o estado dono da cidade
    public function estado()
    {
        return $this->belongsTo('App\Estado');
    }

      //Retorna todas as ofertas da cidade
    public function ofertas()
    {
        return $this->hasMany('App\Oferta');
    }

    //Retorna todas as ofertas da cidade
    public function pessoas()
    {
        return $this->hasMany('App\Pessoa');
    }
      
    
    //Retorna todas as necessidades da cidade
    public function necessidades()
    {
        return $this->hasMany('App\Necessidade');
    }

    //Retorna cidade por nome e estado
    //Se não encontrar retorna nova instância
    public static function getByNomeEstado($nome, $estado)
    {
        if ($nome == null or $estado == null) {
            return new Cidade();
        }

        $cidades = Cidade::where('nome', $nome)->where('estado_id', $estado)->get();
        if ($cidades->count() > 0) {
            return $cidades[0];
        }

        return new Cidade();
    }

    //Verifica se a cidade já está cadastrada
    //Se estiver retorna true
    public static function cidadeCadastrada($nome, $estado)
    {
        if ($nome == null or $estado == null) {
            return false;
        }

        $cidades = Cidade::where('nome', $nome)->where('estado_id', $estado)->get();
        if ($cidades->count() > 0) {
            return true;
        }

        return false;
    }

    //Retorna as cidades cadastradas do estado 1, ignorando a cidade com o id = 0;
    public static function getCidadesCadastradas_1()
    {
        return Cidade::where('id', '!=', 0)->where('estado_id', 1)->get();
    }

    public static function getByEstado($id)
    {
        if ($nome == null or $estado == null) {
            return new Cidade();
        }

        $cidades = Cidade::where('nome', $nome)->where('estado_id', $estado)->get();
        if ($cidades->count() > 0) {
            return $cidades[0];
        }

        return new Cidade();
    }
}
