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

    public function medicos()
    {
        return $this->belongsToMany('App\Medico', 'especialidade_medico', 'especialidade_id', 'medico_id');
    }
}