<?php

namespace App\Models;

use App\Models\Pivot\OptionAble;
use App\Traits\HasMedia;
use App\Traits\UsesPrivateid;
use Illuminate\Database\Eloquent\Model;

class Cemetery extends Model
{
    use UsesPrivateid, HasMedia;

    const POSTS_PER_PAGE = 15;

    protected $casts = [
        'media' => 'array',
    ];

    protected $fillable = ['name','description','type', 'owner_type', 'owner_id'];
    protected $with = ['media'];

    const TYPES  = [
       ['id'=> 1, 'name' => 'public'],
       ['id'=> 2, 'name' => 'private'],
       ['id'=> 3, 'name' => 'state'],
       ['id'=> 4, 'name' => 'veteran'],
    ];

    public function owner()
    {
        return $this->morphTo();
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function plots()
    {
        return $this->hasMany(Plot::class);    
    }

//    public function coordinates()
//    {
//        return $this->morphOne(Coordinate::class, 'entity');
//    }

    public function classifications()
    {
        return $this->belongsToMany(Classification::class);
    }

    public function options()
    {
        return $this->morphToMany(ServiceOptions::class, 'optionable')
            ->using(OptionAble::class);
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
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

    public function managers()
    {
        return $this->morphToMany(User::class, 'manageable');
    }

    public function media()
    {
        return $this->morphToMany(Media::class, 'mediable');
    }
}
