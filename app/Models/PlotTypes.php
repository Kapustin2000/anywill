<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlotTypes extends Model
{
    public function plots()
    {
        return $this->belongsToMany(Plot::class);
    }
}
