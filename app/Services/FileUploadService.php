<?php

namespace App\Services;

use App\Models\File;
use App\Models\Media;
use App\Services\Interfaces\ImageUploadServiceInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

Class FileUploadService extends TransactionAbstractService {

    protected $model,$files = array();

    function __construct(File $file)
    {
        $this->model = $file;
    }

    public function handleFileUpload($files)
    {
        foreach ($files as $file) {
            if($this->canHandleFile($file)) {

                $file_id = $this->model->create(
                    [
                        'name' => $file->getClientOriginalName(),
                        'meta' => [
                            'mimetype' => $file->getClientMimeType(),
                            'ext' => $file->guessClientExtension(),
                            'size' => $file->getSize(),
                        ],
                        'path' => $this->save($file),
                    ]
                )->id;

                array_push($this->files, $file_id );
            }

        }

        return $this->files;
    }


    protected function canHandleFile($file)
    {
        return $file !== null;
    }


    protected function save($file){
        $name = Str::random(64);

        return Storage::putFileAs('tmp', $file, $name);
    }
} 