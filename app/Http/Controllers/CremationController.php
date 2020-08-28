<?php

namespace App\Http\Controllers;

use App\Models\Cremation;
use App\Repositories\Interfaces\CremationRepositoryInterface;
use App\Services\Dto\CremationDto;
use App\Services\Interfaces\CremationServiceInterface;
use Illuminate\Http\Request;

class CremationController extends Controller
{
    protected $service, $repo;

    function __construct(CremationServiceInterface $service, CremationRepositoryInterface $repo)
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
        return $this->service->transaction(new CremationDto($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function show(Cremation $cremation)
    {
        return $cremation->load('options');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cremation $cremation)
    {
        return $this->service->transaction(new CremationDto($request->all()), $cremation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cremation $cremation)
    {
        return $cremation->delete();
    }
}
