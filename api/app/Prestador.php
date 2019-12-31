<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOneOrMany;

class Prestador extends Model
{
    protected $table = 'prestadores';

    protected $fillable = [
        'nrConselho',
        'user_id',
        'perfil_id'
    ];

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
    public function especialidades()
    {
        return $this->belongsToMany('App\Especialidade','especialidade_prestador' ,'prestador_id', 'especialidade_id');
    }
    public function tipoPrestador()
    {
        return $this->belongsTo('App\TipoPrestador','tipoPrestador_id');
    }
}
