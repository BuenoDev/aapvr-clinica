<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;

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
