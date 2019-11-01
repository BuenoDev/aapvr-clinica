<?php

namespace App\Repositories;

use App\Telefone;

class TelefoneRepository extends BaseRepository{
    public function __construct(Telefone $model)
    {
        $this->model = $model;
    }

    public static function createMany($params,$owner){
        $telefones = [];
        foreach($params as $param){
            $param['dono_type']  = get_class($owner);
            $param['dono_id']    = $owner->id;
            $param['created_at'] = now();
            $param['updated_at'] = now();
            array_push($telefones,$param);
        }
        return Telefone::insert($telefones);
    }

}
