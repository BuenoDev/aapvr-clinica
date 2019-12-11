<?php

namespace App\Http\Controllers;

use App\Repositories\TipoPrestadorRepository;
use App\TipoPrestador;
use Illuminate\Http\Request;

class TipoPrestadorController extends Controller
{
    public function __construct(TipoPrestadorRepository $repo){
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
            $this->repo->all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->repo->create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoPrestador  $tipoPrestador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoPrestador $tipoPrestador)
    {
        $this->repo->setModel($tipoPrestador);
        $this->repo->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoPrestador  $tipoPrestador
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoPrestador $tipoPrestador)
    {
        $this->repo->setModel($tipoPrestador);
        $this->repo->delete();
    }
}