<?php

namespace App\Http\Controllers;

use App\Models\FuneralHome;
use App\Services\Dto\FuneralHomeDto;
use App\Services\Interfaces\FuneralHomeServiceInterface;
use Illuminate\Http\Request;

class FuneralHomeController extends Controller
{
    protected $service, $repo;

    function __construct(FuneralHomeServiceInterface $service, FuneralHomeServiceInterface $repo)
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
        return $this->service->transaction(new FuneralHomeDto($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function show(FuneralHome $home)
    {
        return $home->load('options');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FuneralHome $home)
    {
        return $this->service->transaction( new FuneralHomeDto($request->all()), $home);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function destroy(FuneralHome $home)
    {
        return $home->delete();
    }
}
