<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Models\User;
use App\Repositories\Interfaces\CemeteryRepositoryInterface;
use App\Services\Dto\CemeteryDto;
use App\Services\Interfaces\CemeteryServiceInterface;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function __invoke()
    {
        return request()->user()->managers;
    }
}
