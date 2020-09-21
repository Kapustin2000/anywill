<?php

namespace App\Repositories;

use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Models\Cremation;
use App\Models\Laboratory;
use App\Models\Organization;
use App\Repositories\Interfaces\CemeteryRepositoryInterface;
use App\Repositories\Interfaces\CremationRepositoryInterface;
use App\Repositories\Interfaces\LaboratoryRepositoryInterface;
use App\Repositories\Interfaces\RepositoryInterface;
use App\Services\Interfaces\CemeteryServiceInterface;
 


Class OrganizationRepository implements RepositoryInterface {

    protected $model;
    
    function __construct(Organization $model)
    {
        $this->model = $model->with('options');
    }

    public function all()
    {
        return $this->model->get();
    }
    
    public function find($id)
    {
        return $this->model->find($id);
    }

} 