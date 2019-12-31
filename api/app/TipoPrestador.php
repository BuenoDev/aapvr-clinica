<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPrestador extends Model
{
    protected $table = 'tipo_prestador';

    protected $fillable = [
        'nome'
    ];

    public function prestadores()
    {
        return $this->hasMany('App\Prestador');
    }
}