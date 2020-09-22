<?php

namespace App\Repositories;

use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Repositories\Interfaces\CemeteryRepositoryInterface;
use App\Repositories\Interfaces\RepositoryInterface;
use App\Services\Interfaces\CemeteryServiceInterface;



Class CemeteryRepository implements RepositoryInterface, CemeteryRepositoryInterface {

    protected $model;
    
    function __construct(Cemetery $model)
    {
        $this->model = $model->with('classifications', 'options', 'coordinates');
    }

    public function all()
    {
        $this->model->when($search = request('search'), function ($q) use ($search) {
            return $q->where('private_id', 'like' , '%'.$search.'%')
                     ->orWhere('name', 'like' , '%'.$search.'%');
        });

        return $this->model->paginate(request('per_page') ?? Cemetery::POSTS_PER_PAGE);
    }
    
    public function find($id)
    {
        return $this->model->find($id);
    }

} 