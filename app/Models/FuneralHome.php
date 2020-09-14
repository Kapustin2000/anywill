<?php

namespace App\Models;

use App\Traits\UsesPrivateid;
use Illuminate\Database\Eloquent\Model;

class FuneralHome extends Model
{
    use UsesPrivateid;
    
    protected $fillable = ['name', 'description', 'total_capacity'];

    const POSTS_PER_PAGE = 15;
    
    public function owner()
    {
        return $this->morphTo();
    }
    
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

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function managers()
    {
        return $this->morphToMany(Manager::class, 'manageable');
    }
}
