<?php

namespace App\Http\Controllers;

use App\Http\Requests\PacienteRequest;
use App\Http\Resources\PacienteResource;
use App\Paciente;
use App\Repositories\PacienteRepository;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function __construct(PacienteRepository $repo)
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
            PacienteResource::collection($this->repo->all()),
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PacienteRequest $request)
    {
        $this->repo->create($request->formated());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(PacienteRequest $request, Paciente $paciente)
    {
        $this->repo->setModel($paciente);
        $this->repo->update($request->formated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paciente $paciente)
    {
        $this->repo->setModel($paciente);
        $this->repo->delete();
    }
}
