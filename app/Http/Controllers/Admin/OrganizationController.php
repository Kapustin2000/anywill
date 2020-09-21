<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Repositories\OrganizationRepository;
use App\Services\Dto\OrganizationDto;
use App\Services\OrganizationService;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    protected $service, $repo;

    public function __construct(OrganizationService $service, OrganizationRepository $repo)
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
        return $this->service->transaction(new OrganizationDto($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        return $this->repo->find($organization->id);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        return $this->service->transaction(new OrganizationDto($request->all()), $organization);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        return $organization->delete();
    }
}
