<?php

namespace App\Models;

use App\Pivots\CemeteryService;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'entity_id', 'parent_id'];
    protected $appends = ['entity', 'type'];
    protected $hidden = ['input_type_id', 'entity_id'];


    const ENTITIES  = [
        'cemetery',
        'cremation',
        'laboratory'
    ];

    public function getTypeAttribute()
    {
        return config('inputs')[$this->input_type_id];
    }

    public function getEntityAttribute()
    {
        return config('entities')[$this->entity_id];
    }

    public function options()
    {
        return $this->hasMany(ServiceOptions::class);
    }
    
    public function cemeteries()
    {
        return $this->belongsToMany(Cemetery::class);
    }

    public function cremations()
    {
        return $this->belongsToMany(Cremation::class);
    }
    
    
    public function media()
    {
        return $this->hasManyThrough(CemeteryService::class, Cemetery::class);
    }


}
