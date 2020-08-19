<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
    protected $fillable = ['coordinates'];

    public function cemetery()
    {
        return $this->belongsTo(Cemetery::class, 'entity');
    }


    public function plot()
    {
        return $this->belongsTo(Plot::class, 'entity');
    }
}
