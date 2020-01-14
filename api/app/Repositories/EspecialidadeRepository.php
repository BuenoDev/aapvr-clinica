<?php

namespace App\Repositories;

use App\Especialidade;

class EspecialidadeRepository extends BaseRepository{
    public function __construct(Especialidade $model)
    {
        $this->model = $model;
    }

}
