<?php

namespace App\Services;

use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Models\Service;
use App\Services\Dto\ServiceDto;
use App\Services\Interfaces\CemeteryServiceInterface;
use Illuminate\Http\Request;

Class ServicesService {

    protected $services_array = [];

    public function save(ServiceDto $dto)
    {
        foreach ($dto->services as $data) {
            array_push($this->services_array, $this->persistService($data, $data['id'] ?? false));
        }

        return $this->services_array;

    }



    protected function persistService($data, $id = null)
    {
        if($id) {
            $service = Service::find($id);
            $service->update(['name'=> $data['name']]);
        }else{
            $service = Service::create($data);
        }

        if(isset($data['options'])) {
            foreach($data['options'] as $option) {
                $service->options()->updateOrCreate(
                    ['id' => $option['id'] ?? null], $option
                );
            }
        }

        return $service;
    }
}