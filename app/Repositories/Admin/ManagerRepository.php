<?php

namespace App\Repositories\Admin;

use App\Models\Manager;
use App\Repositories\Interfaces\RepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;


Class ManagerRepository implements RepositoryInterface, UserRepositoryInterface {

    protected $model;
    
    function __construct(Manager $model)
    {
        $this->model = $model->with('permissions');
    }

    public function all()
    {
        if($search = request('search')) {
            $this->model = $this->model->when($search, function ($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                    ->orWHere('email', 'like', '%'.$search.'%' )
                    ->orWhere('username', 'like', '%'.$search.'%');
            });
        }

        return $this->model->paginate((int)request('per_page') ?? Manager::POSTS_PER_PAGE);
    }
    
    public function find($id)
    {
        return $this->model->find($id);
    }

} 