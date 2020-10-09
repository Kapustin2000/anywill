<?php

namespace App\Http\Controllers;

use App\Http\Resources\Cemetery\CemeteryCollectionResource;
use App\Http\Resources\Cemetery\CemeterySingleResource;
use App\Http\Resources\CemeteryResource;
use App\Models\Cemetery;
use App\Repositories\Interfaces\CemeteryRepositoryInterface;
use App\Services\CemeteryService;
use App\Services\Dto\CemeteryDto;
use App\Services\Interfaces\CemeteryServiceInterface;
use Illuminate\Http\Request;

class CemeteryController extends Controller
{
    protected $service, $repo; 
    
    public function __construct(CemeteryService $service, CemeteryRepositoryInterface $repo)
    {
        $this->service = $service;
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CemeteryCollectionResource::collection(($this->repo->all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->transaction(new CemeteryDto($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cemetery  $cemetery
     * @return \Illuminate\Http\Response
     */
    public function show(Cemetery $cemetery)
    {
        return new CemeterySingleResource($cemetery, true);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cemetery  $cemetery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cemetery $cemetery)
    {
        return $this->service->transaction(new CemeteryDto($request->all()), $cemetery);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cemetery  $cemetery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cemetery $cemetery)
    {
        return $cemetery->delete();
    }
}
