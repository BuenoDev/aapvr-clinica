<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrestadorRequest;
use App\Prestador;
use App\Repositories\PrestadorRepository;
use Illuminate\Http\Request;

class PrestadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Prestador::with('enderecos','telefones')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrestadorRequest $request, PrestadorRepository $prestadorRepository)
    {
        $prestadorRepository->create($request->formated());
        return response()->json();
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Prestador  $prestador
     * @return \Illuminate\Http\Response
     */
    public function show(Prestador $prestador)
    {
        //
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
    public function destroy(Prestador $prestador)
    {
        $prestador->delete();        
    }
}
