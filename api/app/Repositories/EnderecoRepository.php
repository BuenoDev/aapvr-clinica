<?php

namespace App\Repositories;

use App\Endereco;

class EnderecoRepository extends BaseRepository{
    public function __construct(Endereco $model)
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

    /**
     * Atualiza ou insere varios registros a partir dos parametros
     * atualizando se houver id
     *
     * @param array $params
     * @param Model $owner
     * @return array
     */
    public function updateOrCreate($params,$owner){
      $toUpdate = [];
      $toCreate = [];

      foreach($params as $param){
        if(isset($param['id'])) array_push($toUpdate,$param);
        else array_push($toCreate,$param);
      }

      //Update
      foreach($toUpdate as $param) Endereco::find($param['id'])->update($param);

      //Create many
      $this->createMany($toCreate,$owner);

      return true;
    }
}
