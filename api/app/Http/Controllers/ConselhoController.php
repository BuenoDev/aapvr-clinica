<?php

namespace App\Http\Controllers;
use App\Http\Requests\ConselhoRequest;
use App\Conselho;
use App\Repositories\ConselhoRepository;
use Illuminate\Http\Request;


class ConselhoController extends Controller
{
    public function __construct(ConselhoRepository $repo)
    {
           $this->repo = $repo;
    }

    public function index()
    {
        return response()->json($this->repo->all());
    }

    public function store (ConselhoRequest $request)
    {
        $this->repo->create($request->all());
    }

    public function update(ConselhoRequest $request, Conselho $conselho)
    {
        $this->repo->setModel($conselho);
        $this->repo->update($request->all());
    }

    public function destroy(Conselho $conselho)
    {
        $this->repo->setModel($conselho);
        $this->repo->delete();
    }

}