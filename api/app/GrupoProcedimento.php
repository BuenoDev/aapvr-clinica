<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoProcedimento extends Model
{
    protected $table = 'grupo_procedimentos';
    protected $fillable = ['descricao'];

    public function procedimentos() 
     {
        return $this->hasMany(Procedimento::class);
     }
}
