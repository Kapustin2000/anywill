<?php
namespace App\Repositories\Interfaces;


use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;

interface RepositoryInterface{
    public function all();
    
    public function find($id);
}