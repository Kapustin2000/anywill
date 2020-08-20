<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Services\Interfaces\ImageUploadServiceInterface;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    protected $service;

    public function __construct(ImageUploadServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->handleImageUpload($request->file('file'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        return $media->delete();
    }
}
