<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use App\Repositories\Interfaces\LaboratoryRepositoryInterface;
use App\Services\Dto\LaboratoryDto;
use App\Services\Interfaces\LaboratoryServiceInterface;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    protected $service, $repo;

    function __construct(LaboratoryServiceInterface $service, LaboratoryRepositoryInterface $repo)
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
        return $this->repo->all();
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->transaction(new LaboratoryDto($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function show(Laboratory $laboratory)
    {
        return $laboratory->load('options');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laboratory $laboratory)
    {
        return $this->service->transaction(new LaboratoryDto($request->all()), $laboratory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laboratory $laboratory)
    {
        return $laboratory->delete();
    }
}
