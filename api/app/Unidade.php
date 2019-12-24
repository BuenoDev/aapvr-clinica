<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    protected $table = 'unidades';

    protected $fillable = [
        'nome',
        'regans'
    ];

    public function prestadores()
    {
        return $this->belongsToMany('App\Prestador', 'alocacao', 'unidade_id', 'prestador_id');
    }
    public function endereco()
    {
        return $this->morphOne('App\Endereco','dono');
    }
}
