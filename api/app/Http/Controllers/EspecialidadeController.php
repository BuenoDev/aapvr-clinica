<?php

namespace App\Http\Controllers;

use App\Especialidade;
use App\Http\Requests\EspecialidadeRequest;
use App\Repositories\EspecialidadeRepository;

class EspecialidadeController extends Controller
{
    public function __construct(EspecialidadeRepository $repo){
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
    public function store(EspecialidadeRequest $request)
    {
        $this->repo->create($request->formated());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Especialidade  $especialidade
     * @return \Illuminate\Http\Response
     */
    public function update(EspecialidadeRequest $request, Especialidade $especialidade)
    {
        $this->repo->setModel($especialidade);
        $this->repo->update($request->formated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Especialidade  $especialidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Especialidade $especialidade)
    {
        $this->repo->setModel($especialidade);
        $this->repo->delete();
    }
}
