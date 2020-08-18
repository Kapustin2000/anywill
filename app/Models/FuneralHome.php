<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuneralHome extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function options()
    {
        return $this->belongsToMany(ServiceOptions::class);
    }

    public function rooms()
    {
        return $this->hasMany(FuneralHomeRooms::class);
    }
}
