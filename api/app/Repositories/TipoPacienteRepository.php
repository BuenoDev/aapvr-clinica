<?php

namespace App\Repositories;

use App\TipoPaciente;

class TipoPacienteRepository extends BaseRepository{
    public function __construct(TipoPaciente $model)
    {
        $this->model = $model;
    }

}