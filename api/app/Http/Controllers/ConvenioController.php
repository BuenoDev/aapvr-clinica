<?php

namespace App\Http\Controllers;
use App\Http\Requests\ConvenioRequest;
use App\Convenio;
use App\Repositories\ConvenioRepository;
use Illuminate\Http\Request;


class ConvenioController extends Controller
{
    public function __construct(ConvenioRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return response()->json($this->repo->all());
    }

    public function store(ConvenioRequest $request)
    {
        $this->repo->create($request->all());
    }

    public function update(ConvenioRequest $request, Convenio $convenio)
    {
        $this->repo->setModel($convenio);
        $this->repo->update($request->all());
    }

    public function destroy(Convenio $convenio)
    {
        $this->repo->setModel($convenio);
        $this->repo->delete();
    }

}