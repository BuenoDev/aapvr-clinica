<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conselho extends Model
{
    protected $table = 'conselhos';
    protected $fillable = [
        'numero',
        'sigla',
        'nome'
    ];

    public function prestador()
    {
      return $this->belongsTo(Prestador::class);
    }
}
