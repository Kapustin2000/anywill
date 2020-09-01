<?php
namespace App\Services\Interfaces;


use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Models\Laboratory;
use App\Services\Dto\LaboratoryDto;
use Illuminate\Http\Request;

interface LaboratoryServiceInterface{
    public function save(LaboratoryDto $data) : Laboratory;

    public function update(LaboratoryDto $data, Laboratory $laboratory) : Laboratory;
}