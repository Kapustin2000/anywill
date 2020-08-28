<?php

namespace App\Repositories;

use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Models\Order;
use App\Repositories\Interfaces\CemeteryRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\RepositoryInterface;
use App\Services\Interfaces\CemeteryServiceInterface;
 


Class OrderRepository implements RepositoryInterface, OrderRepositoryInterface {

    protected $model;
    
    function __construct(Order $model)
    {
        $this->model = $model;
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