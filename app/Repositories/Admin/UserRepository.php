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
        return $this->model->get();
    }
    
    public function find($id)
    {
        return $this->model->find($id);
    }

} 