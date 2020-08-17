<?php

namespace App\Repositories;

use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Models\Service;
use App\Repositories\Interfaces\CemeteryRepositoryInterface;
use App\Repositories\Interfaces\RepositoryInterface;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Services\Interfaces\CemeteryServiceInterface;
 


Class ServiceRepository implements RepositoryInterface, ServiceRepositoryInterface {

    protected $model;
    
    function __construct()
    {
        $this->model = new Service();
    }

    public function all()
    {
        return $this->model->with('options')->get();
    }
    
    public function find($id)
    {
        return $this->model->find($id);
    }

} 