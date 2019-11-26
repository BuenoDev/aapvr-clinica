<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedimento extends Model
{
    protected $table = 'procedimentos';
    protected $fillable = [
        'codigo',
        'procedimento',
        'status',
        'grupo_procedimento_id'
    ];
    
    public function grupoprocedimento()
    {
      return $this->belongsTo(GrupoProcedimento::class);
    }

}
