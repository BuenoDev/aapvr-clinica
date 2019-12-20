<?php

namespace App\Http\Controllers;

use App\Prestador;
use App\Http\Requests\PrestadorRequest;
use App\Http\Resources\PrestadorResource;
use App\Repositories\PrestadorRepository;
use App\Repositories\UserRepository;

class PrestadorController extends Controller
{
    public function __construct(PrestadorRepository $repo)
    {
        $this->repo = $repo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            PrestadorResource::collection($this->repo->all())
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrestadorRequest $request)
    {
        $params = $request->formated();

        $this->repo->create($params);

        return response()->json();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prestador  $prestador
     * @return \Illuminate\Http\Response
     */
    public function update(PrestadorRequest $request, Prestador $prestador, PrestadorRepository $repo)
    {
        $repo->setModel($prestador);
        $repo->update($request->formated());
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prestador  $prestador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestador $prestador,PrestadorRepository $repo)
    {
        $repo->setModel($prestador);
        $repo->delete();
    }
}
