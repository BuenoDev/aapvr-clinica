<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOneOrMany;

class Prestador extends Model
{
    protected $table = 'prestadores';

    protected $fillable = [
        'nome',
        'cpf',
        'rg',
        'nrConselho',
        'user_id',
        'perfil_id'
    ];

    public function telefones()
    {
        return $this->hasManyThrough('App\Perfil', 'App\Telefone');
    }
    public function enderecos()
    {
        return $this->hasManyThrough('App\Perfil', 'App\Telefone');
    }
    public function perfil(){
        return $this->belongsTo('App\Perfil','perfil_id');
    }
    public function unidades()
    {
        return $this->belongsToMany('App\Unidade', 'alocacao', 'prestador_id', 'unidade_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function medico()
    {
        return $this->hasOne('App\Medico');
    }
}
