<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = ['name', 'description', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
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
}
