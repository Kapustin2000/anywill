<?php

namespace App\Services;

use App\Models\Cemetery;
use App\Models\User;
use App\Services\Dto\UserDto;
use App\Services\Interfaces\UserServiceInterface;

Class UserService extends AbstractService implements UserServiceInterface
{

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function persist($dto) : User
    {
        $this->persistRelation($this->model->contacts(), $dto->contacts);

        $this->persistRelation($this->model->addresses(), $dto->addresses);

        $this->persistRelation($this->model->comments(), $dto->comments);

        $this->model->media()->sync($dto->media);

        return $this->model;
    }
} 