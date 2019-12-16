<?php

namespace App\Http\Controllers;

use App\TipoPaciente;
use Illuminate\Http\Request;
use App\Repositories\TipoPacienteRepository;


class TipoPacienteController extends Controller
{
    public function __construct(TipoPacienteRepository $repo)
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoPaciente  $tipoPaciente
     * @return \Illuminate\Http\Response
     */
    public function show(TipoPaciente $tipoPaciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoPaciente  $tipoPaciente
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoPaciente $tipoPaciente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoPaciente  $tipoPaciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoPaciente $tipoPaciente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoPaciente  $tipoPaciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoPaciente $tipoPaciente)
    {
        //
    }
}