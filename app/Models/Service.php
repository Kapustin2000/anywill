<?php

namespace App\Models;

use App\Pivots\CemeteryService;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'description', 'entity_id', 'parent_id'];
    protected $appends = ['entity', 'type'];
    protected $hidden = ['input_type_id', 'entity_id'];

    public function getTypeAttribute()
    {
        return config('inputs')[$this->input_type_id ?? 0];
    }

    public function getEntityAttribute()
    {
        return config('entities')[$this->entity_id ?? 0];
    }

    public function dependencies()
    {
        return $this->belongsToMany(ServiceOptions::class, 'service_dependencies');
    }

    public function options()
    {
        return $this->hasMany(ServiceOptions::class);
    }
    
    public function cemeteries()
    {
        return $this->morphedByMany(Cemetery::class, 'entity_option');
    }

    public function cremations()
    {
        return $this->belongsToMany(Cremation::class);
    }

    public function laboratories()
    {
        return $this->belongsToMany(Laboratory::class);
    }

    public function funeral_home()
    {
        return $this->belongsToMany(FuneralHome::class);
    }

    public function scopeGetWithDependencyCheck($q, $options)
    {
        return $q->whereIn('id', function ($query) use ($options){
            $query->selectRaw('sd1.service_id')
                ->whereIn('sd1.service_options_id', $options)
                ->from('service_dependencies as sd1')
                ->havingRaw('COUNT(sd1.service_id) = services.dependencies_count')
                ->groupBy('sd1.service_id');
        });
    }


}
