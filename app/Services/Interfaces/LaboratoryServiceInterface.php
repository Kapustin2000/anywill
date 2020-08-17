<?php
namespace App\Services\Interfaces;


use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Models\Laboratory;
use Illuminate\Http\Request;

interface LaboratoryServiceInterface{
    public function save(Request $request, Laboratory $laboratory = null) : Laboratory;
}