<?php

namespace App\Http\Controllers\Admin;

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
        $managers = User::where('role', 2);

        $managers->when($search = request('search'), function ($q) use ($search) {
            return $q->where('name', 'like' , '%'.$search.'%')
                ->orWhere('username', 'like' , '%'.$search.'%')
                ->orWhere('email', 'like' , '%'.$search.'%');
        });

        return $managers->get();
    }
}
