<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function create($params){
        $user =  User::create([
            'name' => $params['name'],
            'email' => $params['email'],
            'password' => Hash::make($params['password']),
        ]);
        return $user;
    }
    public function createDefault($params){
        $params['password'] = '123456';
        return $this->create($params);
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