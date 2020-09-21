<?php
namespace App\Services\Interfaces;

use App\Models\User;  
use App\Services\Dto\UserDto;

interface UserServiceInterface{
    public function save(UserDto $data) : User;

    public function update(UserDto $data, User $user) : User;
}