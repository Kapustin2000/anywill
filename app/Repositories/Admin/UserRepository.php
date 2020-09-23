<?php

namespace App\Repositories\Admin;

use App\Models\User;
use App\Repositories\Interfaces\RepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;



Class UserRepository implements RepositoryInterface, UserRepositoryInterface {

    protected $model;
    
    function __construct(User $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        if($search = request('search')) {
            $this->model->when($search, function ($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                    ->orWHere('email', 'like', '%'.$search.'%' )
                    ->orWhere('username', 'like', '%'.$search.'%');
            });
        }

        return $this->model->paginate((int)request('per_page') ?? User::POSTS_PER_PAGE);
    }
    
    public function find($id)
    {
        return $this->model->find($id);
    }

} 