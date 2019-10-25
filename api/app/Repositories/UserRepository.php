<?php

namespace App\Repositories;

use App\User;

class UserRepository extends BaseRepository{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function paginateAll($rows){
        return $this->model->with('roles','permissions')->paginate($rows);
    }
    //TODO: Implementar fuzzy searching
    public function search($param){
        return $this->model->where('name','like','%' . $param . '%')->with('roles','permissions');
    }
    public function revoke($role){
        return $this->model->removeRole($role);
    }
}
