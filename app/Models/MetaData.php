<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetaData extends Model
{
    public function options() {
        return $this->hasMany(ServiceOptions::class);
    }
}
