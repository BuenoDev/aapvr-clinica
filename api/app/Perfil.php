<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'perfil';

    protected $fillable = [
        'nome',
        'rg',
        'cpf',
    ];


    public function user()
    {
        return $this->hasOne('App\User','perfil_id');
    }
    public function prestador()
    {
        return $this->belongsTo('App\Prestador');
    }
    public function enderecos()
    {
        return $this->morphMany('App\Endereco','dono');
    }
    public function telefones()
    {
        return $this->morphMany('App\Telefone','dono');
    }
}