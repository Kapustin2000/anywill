<?php

namespace App\Repositories;

use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Models\Cremation;
use App\Models\FuneralHome;
use App\Models\Laboratory;
use App\Repositories\Interfaces\CemeteryRepositoryInterface;
use App\Repositories\Interfaces\CremationRepositoryInterface;
use App\Repositories\Interfaces\LaboratoryRepositoryInterface;
use App\Repositories\Interfaces\RepositoryInterface;
use App\Services\Interfaces\CemeteryServiceInterface;
 


Class FuneralHomeRepository implements RepositoryInterface, CremationRepositoryInterface {

    protected $model;
    
    function __construct()
    {
        $this->model = (new FuneralHome())->with('options');
    }

    public function all()
    {
        return $this->model->all();
    }
    
    public function find($id)
    {
        return $this->model->find($id);
    }

} 