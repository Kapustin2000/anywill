<?php

namespace App\Services;

use App\Models\Laboratory;
use App\Services\Interfaces\LaboratoryServiceInterface;
use Illuminate\Http\Request;

Class LaboratoryService implements LaboratoryServiceInterface {


    public function save(Request $request, Laboratory $laboratory = null) : Laboratory
    {
        if($laboratory) {
            $laboratory->save($request->all());
        }else {
            $laboratory = Laboratory::create($request->all());
        }
        
        $laboratory->services()->sync($request->input('services'));
        
        return $laboratory;
    }

} 