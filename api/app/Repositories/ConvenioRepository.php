<?php

namespace App\Repositories;

use App\Convenio;

class ConvenioRepository extends BaseRepository{
    public function __construct(Convenio $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return parent::all();
    }

    /**
     * Cria novo convenio
     *
     * @param [array] $params
     * @return App\Paciente
     */
    public function create($params)
    {
        return parent::create($params);
    }

    /**
     * Atualiza convenio
     *
     * @param [array] $params
     * @return App\Paciente
     */
    public function update($params)
    {
        return parent::update($params);
    }
}