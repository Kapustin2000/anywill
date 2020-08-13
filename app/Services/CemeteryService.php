<?php

namespace App\Services;

use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Services\Interfaces\CemeteryServiceInterface;

Class CemeteryService implements CemeteryServiceInterface {


    public function save(CemeteryRequest $request, Cemetery $cemetery = null)
    {
        if($cemetery)  return $cemetery->save($request);
    }

} 