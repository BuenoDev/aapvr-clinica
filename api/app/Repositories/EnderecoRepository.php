<?php

namespace App\Repositories;

use App\Endereco;

class EnderecoRepository extends BaseRepository{
    public function __construct(Endereco $model)
    {
        $this->model = $model;
    }

    public static function createMany($params,$owner){
        $enderecos = [];
        foreach( $params as $param){
            $param['dono_type']  = get_class($owner);
            $param['dono_id']    = $owner->id;
            $param['created_at'] = now();
            $param['updated_at'] = now();
            array_push($enderecos,$param);
        }
        return Endereco::insert($enderecos);
    }

}
