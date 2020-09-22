<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    
    public function director() {
        return $this->belongsTo(User::class, 'director_id');
    }

    public function cemeteries()
    {
        return $this->morphedByMany(Cemetery::class, 'manageable');
    }

    public function laboratories()
    {
        return $this->morphedByMany(Laboratory::class, 'manageable');
    }

    public function cremations()
    {
        return $this->morphedByMany(Cremation::class, 'manageable');
    }

    public function organizations()
    {
        return $this->morphedByMany(Organization::class, 'manageable');
    }

    public function media()
    {
        return $this->morphToMany(Media::class, 'mediable');
    }

    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    public function permissions()
    {
        return $this->morphMany(Permission::class, 'permissionable');
    }
}
