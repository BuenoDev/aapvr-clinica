<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestador extends Model
{
    protected $table = 'prestadores';

    protected $fillable = [
        'nome',
        'cpf',
        'rg',
        'nrConselho'
    ];

    public function telefones(){
        return $this->morphMany('App\Telefone','dono');
    }
    public function enderecos(){
        return $this->morphMany('App\Endereco','dono');
    }
}
