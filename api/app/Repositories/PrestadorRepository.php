<?php

namespace App\Repositories;

use App\Prestador;

class PrestadorRepository extends BaseRepository{
    public function __construct(Prestador $model,EnderecoRepository $endereco,TelefoneRepository $telefone)
    {
        $this->model = $model;
        $this->enderecoRepo = $endereco;
        $this->telefoneRepo = $telefone;
    }

    //TODO: vc consegue fazer melhor cara
    public function setModel(Prestador $prestador){
        $this->model = $prestador;
    }
    public function create($params){
        $prestador = Prestador::create($params['prestador']);
        $enderecos = $this->enderecoRepo->createMany($params['enderecos'],$prestador);
        $telefones = $this->telefoneRepo->createMany($params['telefones'],$prestador);

        return compact([
            'prestador',
            'enderecos',
            'telefones'
        ]);
    }
    public function update($params){
        $prestador = $this->model->update($params['prestador']) ? $this->model : abort(500);
        $enderecos = $this->enderecoRepo->updateOrCreate($params['enderecos'],$prestador);
        $telefones = $this->telefoneRepo->updateOrCreate($params['telefones'],$prestador);

        return compact([
            'prestador',
            'enderecos',
            'telefones'
        ]);
    }
}
