<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }
    
    public function cemeteries()
    {
        return $this->morphMany(Cemetery::class, 'owner');
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

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function permissions()
    {
        return $this->belongsTo(Permission::class);
    }
}
