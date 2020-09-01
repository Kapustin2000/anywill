<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use UsesUuid;
    
    protected $fillable = ['data', 'count_options'];
}
