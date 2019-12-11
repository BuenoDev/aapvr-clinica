<?php

namespace App\Repositories;

use App\GrupoProcedimento;

class GrupoProcedimentoRepository extends BaseRepository{
    public function __construct(GrupoProcedimento $model)
    {
        $this->model = $model;
    }

}