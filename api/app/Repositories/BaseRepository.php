<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Cache;

/**
 * Classe abstrata para persistencia de dados utilizando
 * EloquentORM e Cache
 */
abstract class BaseRepository{

    /**
     * Modelo que o repo utilizarar para trabalhar
     *
     * @var [type]
     */
    protected $model;

    /**
     * Array contendo nomes das tabelas
     * para o eager loading do repository
     *
     * @var [type]
     */
    private $eagerLoading;

    /**
     * Atribui model ao repository
     *
     * @param App\Model $model
     * @return void
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * Atribui valores para eager loading
     *
     * @param [array] $array
     * @return void
     */
    public function setEager($array){
        $this->eagerLoading = collect($array);
    }

    public function findById($id){
        return $this->model->find($id);
    }

    /**
     * Retorna valor da chave do cache
     *
     * @return string
     */
    protected final function getCacheKey(){
        return explode('\\', get_class($this->model))[1];
    }

    /**
     * Esquece o valor salvo no cache
     *
     * @return void
     */
    protected final function forgetCache(){
        Cache::forget($this->getCacheKey());
    }

    /**
     * Busca todos os registros do model do banco de dados,
     * buscandoo do cache se existir
     *
     * @param [array] $eagerParams
     * @return Collection
     */
    public function all(){
        $cacheKey = $this->getCacheKey();

        if (Cache::has($cacheKey)) return Cache::get($cacheKey);
        else {
            if( !isset($this->eagerLoading) ) $collection = $this->model->all();
            else $collection = $this->model->with($this->eagerLoading->toArray())->get();

            Cache::put($cacheKey,$collection);
            return $collection;
        }
    }

    /**
     * Insere novo model
     *
     * @param [array] $params
     * @return App\Model
     */
    public function create($params){
        $this->forgetCache();
        return $this->model->create($params);
    }

    /**
     * Atualiza model
     *
     * @param [array] $params
     * @return App\Model
     */
    public function update($params){
        $this->forgetCache();
        return $this->model->update($params);
    }

    /**
     * Deleta o model
     */
    public function delete(){
        $this->forgetCache();
        return $this->model->delete();
    }


}
