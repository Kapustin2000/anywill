<?php

namespace App\Services;

use App\Models\Cemetery;
use App\Models\User;
use App\Services\Dto\UserDto;
use App\Services\Interfaces\UserServiceInterface;

Class UserService extends TransactionAbstractService implements UserServiceInterface
{

    protected $user;

    public function save(UserDto $dto) : UserDto
    {

        return $this->user = $user = User::create($dto->data);
    }

    public function update(UserDto $dto, User $user) : User
    {
        return $this->user = $user->update($dto->data);
    }

} 