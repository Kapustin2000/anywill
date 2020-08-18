<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuneralHomeRooms extends Model
{
    public function funeral_home()
    {
        return $this->belongsTo(FuneralHome::class);
    }
}
