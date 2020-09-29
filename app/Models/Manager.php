<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Passport\HasApiTokens;

class Manager extends Authenticatable
{
    use HasApiTokens;

    protected $guarded = 'managers';
    protected $with = ['director'];
    const POSTS_PER_PAGE = 15;

    public function director() {
        return $this->belongsTo(User::class);
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
        return $this->morphToMany(Permission::class, 'permissionable');
    }
}
