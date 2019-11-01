<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    //
    protected $table = 'telefones';

    protected $fillable = [
        'numero',
        'tipo' // ENUM = 'Residencial','Celular','Comercial'
    ];

    public function dono(){
        return $this->morphTo();
    }
}
