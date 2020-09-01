<?php
namespace App\Services\Interfaces;


use App\Models\Cremation;
use App\Services\Dto\CremationDto;
use Illuminate\Http\Request;

interface CremationServiceInterface{
    public function save(CremationDto $data) : Cremation;

    public function update(CremationDto $data, Cremation $cremation) : Cremation;

}