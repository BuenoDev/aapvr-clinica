<?php

namespace App\Repositories;

interface RepositoryContract{

    public function setModel($model);
    public function all();
    public function create($params);
    public function update($params);
}