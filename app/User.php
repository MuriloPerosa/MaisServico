<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'administrador',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $attributes = [
        'administrador' => false,
    ];


    //Verifica se a senha passada por parâmetro é igual a senha do usuário
    //True é válida
    public function validarSenha($senha = null)
    {
        if (empty($senha)) {
            return false;
        }

        if (crypt($senha, $this->password) === $this->password) {
            return true;
        } else {
            return false;
        }
    }

    //Retorna todas as ofertas do usuário
    public function ofertas()
    {
        return $this->hasMany('App\Oferta');
    }

    

     //Retorna a pessoa do usuário
    public function pessoa()
    {
        return $this->hasOne('App\Pessoa');
    }

        //Retorna todas as necessidades do usuário
    public function necessidades()
    {
        return $this->hasMany('App\Necessidade');
    }
}
