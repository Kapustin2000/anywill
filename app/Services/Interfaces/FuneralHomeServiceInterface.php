<?php
namespace App\Services\Interfaces;

use App\Models\FuneralHome;
use Illuminate\Http\Request;

interface FuneralHomeServiceInterface{
    public function save(Request $request, FuneralHome $funeralHome = null) : FuneralHome;
}