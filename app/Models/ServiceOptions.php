<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOptions extends Model
{
    protected $table = 'service_options';
    protected $hidden = ['pivot'];
    public $timestamps = false;

    protected $fillable = ['name', 'description', 'meta_data_id', 'input_type_id'];

    public function service()
    {
        return $this->morphedByMany(Service::class, 'entity_option');
    }

    public function cemeteries()
    {
        return $this->morphedByMany(Cemetery::class, 'entity_option');
    }

    public function cremations()
    {
        return $this->morphedByMany(Cremation::class, 'entity_option');
    }

    public function laboratories()
    {
        return $this->morphedByMany(Laboratory::class, 'entity_option');
    }

    public function funeral_home()
    {
        return $this->morphedByMany(FuneralHome::class, 'entity_option');
    }

    public function parent() {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function children() {
        return $this->hasMany(static::class, 'parent_id');
    }
}
