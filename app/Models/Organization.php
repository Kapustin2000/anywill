<?php

namespace App\Models;

use App\Traits\UsesPrivateid;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use UsesPrivateid;

    const POSTS_PER_PAGE = 15;
    
    protected $fillable = ['name', 'description', 'user_id'];
    protected $with = ['cemeteries','laboratories','funeral_homes','cremations','managers','media'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cemeteries()
    {
        return $this->morphMany(Cemetery::class, 'owner');
    }

    public function laboratories()
    {
        return $this->morphMany(Laboratory::class, 'owner');
    }

    public function funeral_homes()
    {
        return $this->morphMany(FuneralHome::class, 'owner');
    }

    public function cremations()
    {
        return $this->morphMany(Cremation::class, 'owner');
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
