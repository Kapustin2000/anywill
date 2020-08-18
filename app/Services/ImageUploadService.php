<?php

namespace App\Services;

use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Services\Interfaces\CemeteryServiceInterface;
use App\Services\Interfaces\ImageUploadInterface;
use Illuminate\Support\Facades\Storage;

Class ImageUploadService implements ImageUploadInterface {


    protected $image;

    public function handleImageUpload($image)
    {
        $this->image =$image;

        if($this->canHandleImage()){
            return $this->save();
        }

        return '';
    }


    protected function canHandleImage()
    {
        return $this->image !== null;
    }


    protected function save(){
        $filePath = '/1';

        return Storage::disk('images')->put($filePath, $this->image);
    }
} 