<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaPalavras extends Model
{
    protected $fillable = ['palavra_id', 'categoria_id'];


    public function palavra()
    {
        return $this->belongsTo('App\PalavraChave');
    }
}
