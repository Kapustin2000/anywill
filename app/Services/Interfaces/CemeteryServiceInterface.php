<?php
namespace App\Services\Interfaces;


use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;

interface CemeteryServiceInterface{
    public function save(CemeteryRequest $request, Cemetery $cemetery = null);
}