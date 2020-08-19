<?php
namespace App\Services\Interfaces;


use App\Models\Cremation;
use Illuminate\Http\Request;

interface CremationServiceInterface{
    public function save(Request $request, Cremation $cremation = null) : Cremation;
}