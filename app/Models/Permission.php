<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;
    protected $hidden = ['pivot'];

    public function permissionable()
    {
        return $this->morphTo();
    }
}
