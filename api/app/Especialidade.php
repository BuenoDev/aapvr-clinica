<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    protected $table = 'especialidades';

    protected $fillable = [
        'nome',
        'codigo'
    ];

    public function prestadores()
    {
        return $this->belongsToMany('App\Prestador', 'especialidade_prestador', 'especialidade_id', 'prestador_id');
    }
}
