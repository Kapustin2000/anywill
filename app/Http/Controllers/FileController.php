<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class FileController extends Controller
{
    protected $service;

    public function __construct(FileUploadService $service)
    {
        $this->service = $service;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->handleFileUpload($request->file('files'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        return $file->delete();
    }
}
