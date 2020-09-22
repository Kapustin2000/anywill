<?php

namespace App\Services;

use App\Models\Cemetery;
use App\Models\User;
use App\Services\Dto\UserDto;
use App\Services\Interfaces\UserServiceInterface;

Class UserService extends AbstractService implements UserServiceInterface
{

    protected $user;

    public function save(UserDto $dto) : User
    {
        $this->user = $user = User::create($dto->data);

        return $this->persistUser($dto);
    }

    public function update(UserDto $dto, User $user) : User
    {
        $this->user = $user->update($dto->data);

        return $this->persistUser($dto);
    }

    protected function persistUser(UserDto $dto)
    {
        $this->persistRelation($this->user->contacts(), $dto->contacts);
        $this->persistRelation($this->user->addresses(), $dto->addresses);


        return $this->user;
    }
} 