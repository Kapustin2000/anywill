<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cremation extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coordinates()
    {
        return $this->morphOne(Coordinate::class, 'entity');
    }
}
