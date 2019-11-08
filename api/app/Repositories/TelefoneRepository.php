<?php

namespace App\Repositories;

use App\Telefone;

class TelefoneRepository extends BaseRepository{
    public function __construct(Telefone $model)
    {
        $this->model = $model;
    }

    /**
     * Cria varios registros a partir de um array de parametros
     *
     * @param array $params
     * @param Model $owner
     * @return array
     */
    public function createMany($params,$owner){
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

    /**
     * Atualiza ou insere varios registros a partir dos parametros
     * atualizando se houver id
     *
     * @param array $params
     * @param Model $owner
     * @return array
     */
    public function updateOrCreate($params,$owner){
        $data = [];
        $toUpdate = [];
        $toCreate = [];

        foreach($params as $param){
          if(isset($param['id'])) array_push($toUpdate,$param);
          else array_push($toCreate,$param);
        }
        // $toUpdate = collect($params)->filter(function($param){
        //   return isset($param->id);
        // })->toArray();
        // $toCreate = collect($params)->filter(function($param){
        //   return !isset($param->id);
        // })->toArray();

        //Update
        foreach($toUpdate as $param) Telefone::find($param['id'])->update($param);
        //Create many        
        $this->createMany($toCreate,$owner);        

        return true;
      }

}
