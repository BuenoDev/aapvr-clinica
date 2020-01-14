<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Hash;

/**
 * Atualmente, o UserRepository so esta sendo usado
 * no modulo de permissoes e cadastro de usuarios
 *
 * TODO: atualizar cadastro de usuarios
 * para adicionar o perfil
 */
class UserRepository extends BaseRepository{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function create($params){
        $user =  User::create([
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
