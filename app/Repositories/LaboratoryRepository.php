<?php

namespace App\Repositories;

use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Models\Laboratory;
use App\Repositories\Interfaces\CemeteryRepositoryInterface;
use App\Repositories\Interfaces\LaboratoryRepositoryInterface;
use App\Repositories\Interfaces\RepositoryInterface;
use App\Services\Interfaces\CemeteryServiceInterface;
 


Class LaboratoryRepository implements RepositoryInterface, LaboratoryRepositoryInterface {

    protected $model;
    
    function __construct(Laboratory $model)
    {
        $this->model = $model->with('options');
    }

    public function all()
    {
        $this->model->when($search = request('search'), function ($q) use ($search) {
            return $q->where('private_id', 'like' , '%'.$search.'%')
                ->orWhere('name', 'like' , '%'.$search.'%');
        });
        
        return $this->model->paginate(request('per_page') ?? Laboratory::POSTS_PER_PAGE);
    }
    
    public function find($id)
    {
        return $this->model->find($id);
    }

} 