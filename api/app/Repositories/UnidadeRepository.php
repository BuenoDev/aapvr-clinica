<?php

namespace App\Repositories;

use App\Unidade;

class UnidadeRepository extends BaseRepository{
    public function __construct(Unidade $model,EnderecoRepository $endereco)
    {
        $this->model = $model;
        $this->enderecoRepo = $endereco;
    }

    public function all(){
        $this->setEager([
            'endereco'
        ]);
        return parent::all();
    }
    public function create($params){
        $unidade = parent::create($params['unidade']);
        $this->enderecoRepo->createMany($params['enderecos'],$unidade);

        return $unidade;
    }
    public function update($params){
        $prestador = parent::update($params['unidade']) ? $this->model : abort(500);
        $enderecos = $this->enderecoRepo->updateOrCreate($params['enderecos'],$prestador);

        return compact([
            'prestador',
            'enderecos'
        ]);
    }
}