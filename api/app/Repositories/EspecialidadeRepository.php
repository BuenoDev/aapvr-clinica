<?php

namespace App\Repositories;

use App\Convenio;

class EspecialidadeRepository extends BaseRepository{
    public function __construct(Convenio $model)
    {
        $this->model = $model;
    }

}