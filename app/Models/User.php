<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;
    
    const POSTS_PER_PAGE = 15;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',  'username', 'email', 'password', 'parent_id', 'balance'
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
        if(request()->user()) return $this->morphedByMany(Cemetery::class, 'manageable');
        
        return $this->morphMany(Cemetery::class, 'owner');
    }

    public function laboratories()
    {
        if(request()->user()) return $this->morphedByMany(Laboratory::class, 'manageable');

        return $this->morphMany(Laboratory::class, 'owner');
    }

    public function funeral_homes()
    {
        if(request()->user()) return $this->morphedByMany(FuneralHome::class, 'manageable');

        return $this->morphMany(FuneralHome::class, 'owner');
    }

    public function cremations()
    {
        if(request()->user()) return $this->morphedByMany(Cremation::class, 'manageable');

        return $this->morphMany(Cremation::class, 'owner');
    }

    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function permissions()
    {
        return $this->morphMany(Permission::class, 'permissionable');
    }

    public function director() {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function managers() {
        return $this->hasMany(static::class, 'parent_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'owner');
    }
}
