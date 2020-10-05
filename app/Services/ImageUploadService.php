<?php

namespace App\Services;

use App\Models\Media;
use App\Services\Interfaces\ImageUploadServiceInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

Class ImageUploadService implements  ImageUploadServiceInterface{

    public $model,$images = array();

    function __construct(Media $media)
    {
        $this->model = $media;
    }

    public function handleImageUpload($images)
    {
        foreach ($images as $image) {
            if($this->canHandleImage($image)) {

                $image_id = $this->model->create(
                    [
                        'name' => $image->getClientOriginalName(),
                        'meta' => [
                            'mimetype' => $image->getClientMimeType(),
                            'ext' => $image->guessClientExtension(),
                            'size' => $image->getSize(),
                        ],
                        'path' => $this->save($image),
                    ]
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
        $name = Str::random(64);

        return Storage::putFileAs('tmp', $image, $name);
    }
} 