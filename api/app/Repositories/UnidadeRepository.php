<?php

namespace App\Repositories;

use App\Unidade;

class UnidadeRepository extends BaseRepository{
    public function __construct(Unidade $model,EnderecoRepository $endereco)
    {
        $this->model = $model;
        $this->enderecoRepo = $endereco;
    }

    //TODO: vc consegue fazer melhor cara
    public function setModel(Unidade $unidade){
        $this->model = $unidade;
    }
    public function create($params){
        $prestador = Unidade::create($params['unidade']);
        $enderecos = $this->enderecoRepo->createMany($params['enderecos'],$prestador);

        return compact([
            'prestador',
            'enderecos'
        ]);
    }
    public function update($params){
        $prestador = $this->model->update($params['unidade']) ? $this->model : abort(500);
        $enderecos = $this->enderecoRepo->updateOrCreate($params['enderecos'],$prestador);

        return compact([
            'prestador',
            'enderecos'
        ]);
    }
}
