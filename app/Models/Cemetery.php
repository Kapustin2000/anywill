<?php

namespace App\Models;

use App\Traits\HasMedia;
use App\Traits\UsesPrivateid;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Cemetery extends Model
{
    use UsesPrivateid;

    protected $casts = [
        'media' => 'array',
    ];

    protected $hidden = ['id'];

    protected $fillable = ['name','description','type', 'user_id', 'media'];

    const TYPES  = [
       'public',
       'private',
       'state',
       'veteran'
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

    public function coordinates()
    {
        return $this->morphOne(Coordinate::class, 'entity');
    }

    public function classifications()
    {
        return $this->belongsToMany(Classification::class);
    }

    public function options()
    {
        return $this->morphToMany(ServiceOptions::class, 'entity_options');
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
}
