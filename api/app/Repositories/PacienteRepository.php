<?php

namespace App\Repositories;

use App\Paciente;
// use App\Repositories\BaseRepository;


class PacienteRepository extends BaseRepository{
    public function __construct(Paciente $model,EnderecoRepository $endereco,TelefoneRepository $telefone)
    {
        $this->model = $model;
        $this->enderecoRepo = $endereco;
        $this->telefoneRepo = $telefone;
        $this->setEager([
            'enderecos','telefones'
        ]);
    }

    public function all()
    {
        return parent::all();
    }

    /**
     * Cria novo paciente
     *
     * @param [array] $params
     * @return App\Paciente
     */
    public function create($params)
    {
        $paciente = parent::create($params['paciente']);
        $this->enderecoRepo->createMany($params['enderecos'], $paciente);
        $this->telefoneRepo->createMany($params['telefones'], $paciente);

        return $paciente;
    }

    /**
     * Atualiza paciente
     *
     * @param [array] $params
     * @return App\Paciente
     */
    public function update($params)
    {
        $paciente = parent::update($params['paciente']);
        $this->enderecoRepo->updateOrCreate($params['enderecos'], $paciente);
        $this->telefoneRepo->updateOrCreate($params['telefones'], $paciente);

        return $paciente;
    }
}