<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnidadeRequest;
use App\Repositories\UnidadeRepository;
use App\Unidade;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    public function __construct(UnidadeRepository $repo)
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
        return response()->json($this->repo->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnidadeRequest $request)
    {
        $this->repo->create($request->formated());
        return response()->json();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function update(UnidadeRequest $request, Unidade $unidade)
    {
        $this->repo->setModel($unidade);
        $this->repo->update($request->formated());
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unidade $unidade)
    {
        $this->repo->setModel($unidade);
        $this->repo->delete();
    }
}