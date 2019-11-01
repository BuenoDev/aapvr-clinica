<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'enderecos';

    protected $fillable = [
        'bairro',
        'cep',
        'cidade',
        'complemento',
        'logradouro',
        'tipo',
        'uf'
    ];

    public function dono(){
        return $this->morphTo();
    }
}
