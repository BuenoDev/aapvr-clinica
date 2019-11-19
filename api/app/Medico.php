<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $table = 'medicos';

    protected $fillable = [
        'nrconselho',
        'prestador_id'
    ];

    public function prestador()
    {
        return $this->belongsTo('App\Prestador', 'prestador_id');
    }

    public function especialidades()
    {
        return $this->belongsToMany('App\Especialidade', 'especialidade_medico', 'medico_id', 'especialidade_id');
    }
}