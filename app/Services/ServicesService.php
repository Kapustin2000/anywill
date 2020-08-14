<?php

namespace App\Services;

use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Models\Service;
use App\Services\Interfaces\CemeteryServiceInterface;
use Illuminate\Http\Request;

Class ServicesService {
    
    public function save(Request $request)
    {
        $newServices = [];
        foreach ($request->input('services') as $service) {
            
            $newService = Service::create($service);
            
            if($service['sub']) {
                foreach ($service['sub'] as $sub) {
                    $newService->sub()->create($sub);
                }
            }
            
            array_push($newServices, $newService->id);
        }
        
        return $newServices;
    }
}