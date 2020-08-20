<?php
namespace App\Services\Interfaces;


use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Services\Dto\CemeteryDto;

interface CemeteryServiceInterface{
    public function save(CemeteryDto $data, Cemetery $cemetery = null) : Cemetery;
}