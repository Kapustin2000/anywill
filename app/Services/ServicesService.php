<?php

namespace App\Services;


use App\Models\Service;
use App\Models\ServiceOptions;
use App\Services\Dto\ServiceDto;

Class ServicesService extends TransactionAbstractService {

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
            $id = $service->id;
        }

        if(isset($data['options'])) {
            $service->options()->whereNotIn('id', array_column($data['options'], 'id'))->delete();
            $this->persistOptions($data['options'], $id);
        }

        return $service;
    }


    public function persistOptions($options, $service_id = false)
    {
        foreach($options as $option) {

            $service_option = ServiceOptions::updateOrCreate(['id' => $option['id'] ?? null],
                [
                    'name' => $option['name'] ?? null,
                    'description' => $option['description'] ?? null,
                    'service_id' => $service_id,
                    'input_type_id' => $option['input_type_id'] ?? null,
                    'meta_data_id' =>  $option['meta_data_id'] ?? null
                ]
            );

            if(isset($option['services'])) {
                $service_option->services()->whereNotIn('id', array_column($option['services'], 'id'))->delete();
                foreach($option['services'] as $service) {
                    $service_option->services()->attach($this->persistService($service, $service['id'] ?? false)->id);
                }
            }
        }
    }
}