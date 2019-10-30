<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny',Role::class);
        return [
            'roles' => RoleResource::collection(Role::all()),
            'count' => Role::all()->count()
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',Role::class);
        return Role::create(['name' => $request->role]);
    }

    public function syncPermissions(Role $role, Request $request){
        $this->authorize('update',Role::class);
        $role = $role->syncPermissions($request->permissions);

        // Reassign all roles to sync user permissions
        $users = User::role($role)->get();
        foreach($users as $user){
            $user->removeRole($role);
            $user->assignRole($role);
        }
        return response()->json( new RoleResource($role) );
    }

    public function getUsers(Role $role){
        $this->authorize('view',$role);
        return response()->json(UserResource::collection($role->users));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete',$role);
        $role->delete();
        return response()->json();
    }
}
