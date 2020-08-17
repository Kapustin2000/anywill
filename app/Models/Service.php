<?php

namespace App\Models;

use App\Pivots\CemeteryService;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'entity_id', 'parent_id'];

    const ENTITIES  = [
        'cemetery' => 1,
        'cremation'  => 2
    ];

    public function getTypeAttribute()
    {
        return config('inputs')[$this->input_type_id];
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
