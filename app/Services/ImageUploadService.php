<?php

namespace App\Services;

use App\Models\Media;
use App\Services\Interfaces\ImageUploadServiceInterface;
use Illuminate\Support\Facades\Storage;

Class ImageUploadService extends TransactionAbstractService implements ImageUploadServiceInterface {

    protected $model,$images = array();

    function __construct(Media $media)
    {
        $this->model = $media;
    }

    public function handleImageUpload($images)
    {

        foreach ($images as $image) {

            if($this->canHandleImage($image)) {

                $image_id = $this->model->create(
                    ['path' => $this->save($image)]
                )->id;

                array_push($this->images, $image_id );
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