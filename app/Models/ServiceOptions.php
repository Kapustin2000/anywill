<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOptions extends Model
{
    protected $table = 'service_options';

    protected $fillable = ['name'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function cemeteries()
    {
        return $this->belongsToMany(Cemetery::class);
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
}
