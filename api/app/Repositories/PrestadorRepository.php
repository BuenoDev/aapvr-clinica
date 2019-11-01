<?php

namespace App\Repositories;

use App\Prestador;

class PrestadorRepository extends BaseRepository{
    public function __construct(Prestador $model)
    {
        $this->model = $model;
    }

    public function create($params){
        $prestador = Prestador::create($params['prestador']);
        $enderecos = EnderecoRepository::createMany($params['enderecos'],$prestador);
        $telefones = TelefoneRepository::createMany($params['telefones'],$prestador);
        
        return compact([
            'prestador',
            'enderecos',
            'telefones'
        ]);
    }
}
