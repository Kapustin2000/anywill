<?php

namespace App\Models;

use App\Models\Pivot\OptionAble;
use App\Traits\UsesPrivateid;
use Illuminate\Database\Eloquent\Model;

class FuneralHome extends Model
{
    use UsesPrivateid;
    
    protected $fillable = ['name', 'description', 'total_capacity', 'owner_type', 'owner_id'];
    protected $with = ['media'];

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
        return $this->morphToMany(ServiceOptions::class, 'optionable')
            ->using(OptionAble::class);
    }

    public function rooms()
    {
        return $this->hasMany(FuneralHomeRooms::class);
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
    
    public function managers()
    {
        return $this->morphToMany(User::class, 'manageable');
    }

    public function media()
    {
        return $this->morphToMany(Media::class, 'mediable');
    }
}
