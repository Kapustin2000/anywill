<?php
namespace App\Services\Interfaces;

use App\Models\FuneralHome;
use App\Services\Dto\FuneralHomeDto;
use Illuminate\Http\Request;

interface FuneralHomeServiceInterface{
    public function save(FuneralHomeDto $dto, FuneralHome $funeralHome = null) : FuneralHome;
}