<?php

namespace App\Models;

use App\Models\Pivot\OptionAble;
use App\Traits\UsesPrivateid;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Cremation extends Model
{
    use UsesPrivateid;

    const POSTS_PER_PAGE = 15;
    
    protected $fillable = ['user_id', 'description', 'name'];
    protected $with = ['media'];


    public function owner()
    {
        return $this->morphTo();
    }

    public function files()
    {
        return $this->morphMany(File::class, 'owner');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coordinates()
    {
        return $this->morphOne(Coordinate::class, 'entity');
    }

    public function options()
    {
        return $this->morphToMany(ServiceOptions::class, 'optionable')
            ->using(OptionAble::class);
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
