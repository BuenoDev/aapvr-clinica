<?php

namespace App\Repositories;

use App\Procedimento;

class ProcedimentoRepository extends BaseRepository{
    public function __construct(Procedimento $model)
    {
        $this->model = $model;
        $this->setEager(['grupoprocedimento']);
    }

}