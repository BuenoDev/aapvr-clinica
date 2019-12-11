<?php

namespace App\Repositories;

use App\TipoPrestador;

class TipoPrestadorRepository extends BaseRepository{
    public function __construct(TipoPrestador $model)
    {
        $this->model = $model;
    }

}