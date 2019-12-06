<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = [
        'nome',
        'rg',
        'cpf',
        'mae',
        'dtnascimento',
        'sexo', // M / F
        'estadoCivil', //'Solteiro', 'Casado', 'Divorciado', 'Viuvo'
        'observacao',
    ];

    public function telefones()
    {
        return $this->morphMany('App\Telefone', 'dono');
    }
    public function enderecos () {
        return $this->morphMany('App\Endereco','dono');
    }

}