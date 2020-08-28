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
    
    function __construct(Service $model)
    {
        $this->model = $model->with('options');
    }

    public function all()
    {
        return [
          'cemetery' => $this->model->where('entity_id', 1)->get(),
          'crematory'  => $this->model->where('entity_id', 2)->get(),
          'laboratory'  => $this->model->where('entity_id', 3)->get(),
          'general'  => $this->model->where('entity_id', null)->get()
        ];
    }
    
    public function find($id)
    {
        return $this->model->find($id);
    }

} 