<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plot extends Model
{
    use SoftDeletes;

    public function cemetery()
    {
        return $this->belongsTo(Cemetery::class);
    }
}
