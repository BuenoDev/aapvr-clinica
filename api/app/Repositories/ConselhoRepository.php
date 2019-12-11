<?php

namespace App\Repositories;

use App\Conselho;

class ConselhoRepository extends BaseRepository{
    public function __construct(Conselho $model)
    {
        $this->model = $model;
    }
}