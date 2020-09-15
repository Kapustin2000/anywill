<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Repositories\Admin\ServiceRepository;
use App\Services\Dto\ServiceDto;
use App\Services\ServicesService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $service, $repo;
    
    function __construct(ServicesService $service, ServiceRepository $repo)
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
        return  $services = $this->repo->all();
    }


    public function store(Request $request)
    {
        return $this->service->transaction(new ServiceDto($request->all()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        return $this->service->transaction(new ServiceDto($request->all()), $service);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        return $service->delete();
    }
}
