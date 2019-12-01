<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,UserRepository $user)
    {
        $rows = $request->rowsPerPage;
        $param = $request->searchParam;

        if ($param == '' || $param == null) {
            $users = $user->paginateAll($rows);
            $count = User::count();
        } else {
            $users = $user->search($param)->paginate($rows);
            $count = $user->search($param)->count();
        }

        return response()->json([
            'users' => UserResource::collection($users),
            'count' => $count,
        ]);
    }

    public function unlinked() {
        return User::all()->filter(function($user){
            return $user->prestador === null;
        });
    }

    public function revoke( User $user, Request $request){
        $user = $user->removeRole($request->role);
        return response()->json(new UserResource($user));
    }

    public function syncRoles(User $user, Request $request){
        $user = $user->syncRoles($request->roles);
        return response()->json(new UserResource($user));
    }
    public function syncPermissions(User $user, Request $request){
        $user = $user->syncPermissions($request->permissions);
        return response()->json(new UserResource($user));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}