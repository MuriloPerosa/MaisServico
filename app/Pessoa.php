<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{

    protected $fillable = [
        'cpf', 'rg', 'telefone', 'celular', 'data_nascimento', 'cidade_id', 'user_id',
    ];

    protected $attributes = [
        // 'administrador' => false,
    ];


    //retorna o usuário dono da pessoa
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //retorna a cidade da pessoa
    public function cidade()
    {
        return $this->belongsTo('App\Cidade');
    }


    //Verifica se a data de nascimento do usuário é válida
    //True (Age => 18)
    public static function validarDataNascimento($data = null)
    {
        if (empty($data)) {
            return false;
        }

        $age = 0;

        try {
            $age = Carbon::parse($data)->age;
        } catch (Exception $e) {
            return false;
        }

        if ($age >= 18) {
            return true;
        } else {
            return false;
        }
    }

    //Verifica se o CPF é válido
    //True = válido
    public static function validarCPF($cpf = null)
    {

        // Verifica se um número foi informado
        if (empty($cpf)) {
            return false;
        }

        // Elimina possivel mascara
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        // Verifica se o numero de digitos informados é igual a 11
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se nenhuma das sequências invalidas abaixo
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999') {
            return false;
            // Calcula os digitos verificadores para verificar se o
            // CPF é válido
        } else {

            for ($t = 9; $t < 11; $t++) {

                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf {
                        $c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf {
                    $c} != $d) {
                    return false;
                }
            }

            return true;
        }
    }

    //Retorna pessoa vinculada ao usuário,
    //se não encontrar retorna nova instância.
    // public static function getByUserId($id)
    // {

    //     if ($id == 0) {
    //         return new Pessoa();
    //     }

    //     $pessoa = Pessoa::where('pessoas.user_id', $id)->get();
    //     if ($pessoa->count() === 0) {
    //         return new Pessoa();
    //     }

    //     return $pessoa[0];
    // }

    //Verifica se o cpf já está cadastrado
    //Se estiver retorna true
    public static function cpfCadastrado($cpf = null)
    {
        if ($cpf == null) {
            return true;
        }

        $pessoas = Pessoa::where('pessoas.cpf', $cpf)->get();
        if ($pessoas->count() > 0) {
            return true;
        }
        return false;
    }

    //Verifica se o rg já está cadastrado
    //Se estiver retorna true
    public static function rgCadastrado($rg = null)
    {
        if ($rg == null) {
            return true;
        }

        $pessoas = Pessoa::where('pessoas.rg', $rg)->get();
        if ($pessoas->count() > 0) {
            return true;
        }
        return false;
    }
}
