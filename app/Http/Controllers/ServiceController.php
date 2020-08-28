<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Services\Dto\OrderDto;
use App\Services\Dto\ServiceDto;
use App\Services\ServicesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    protected $service, $repo;
    
    function __construct(ServicesService $service, ServiceRepositoryInterface $repo)
    {
        $this->service = $service;
        $this->repo = $repo;
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($service) {
            $service->options()->delete();
        });
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
        return $this->service->transaction(new ServiceDto($request->all()));
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
