<?php

namespace App\Services;

use App\Services\Interfaces\ImageUploadServiceInterface;
use Illuminate\Support\Facades\Storage;

Class ImageUploadService extends TransactionAbstractService implements ImageUploadServiceInterface {

    protected $images = array();

    public function handleImageUpload($images)
    {

        foreach ($images as $image) {

            if($this->canHandleImage($image)) {
                array_push($this->images, $this->save($image));
            }

        }

        return $this->images;
    }


    protected function canHandleImage($image)
    {
        return $image !== null;
    }


    protected function save($image){
        $filePath = '/1';

        return Storage::disk('public')->put($filePath, $image);
    }
} 