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
        $this->model = $model;
    }

    public function all()
    {
        $this->model->when($search = request('search'), function ($q) use ($search) {
            return $q->where('private_id', 'like' , '%'.$search.'%')
                ->orWhere('name', 'like' , '%'.$search.'%')
                ->orWhereHas('addresses', function( $query ) use ( $search ){
                    $query->where('name', 'like' ,'%'.$search.'%' ); //how to load only matches, no
                });
        });
        
        return $this->model->paginate( (int) request('per_page') ?? Laboratory::POSTS_PER_PAGE);
    }
    
    public function find($id)
    {
        return $this->model->find($id);
    }

} 