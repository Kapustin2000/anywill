<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    const ENTITIES  = [
        'cemetery' => 1,
        'cremation'  => 2
    ];
}
