<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class FuneralHome extends Model
{
    use UsesUuid;
    
    protected $fillable = ['name', 'total_capacity'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
    public function options()
    {
        return $this->morphToMany(ServiceOptions::class, 'entity_options');
    }

    public function rooms()
    {
        return $this->hasMany(FuneralHomeRooms::class);
    }
}
