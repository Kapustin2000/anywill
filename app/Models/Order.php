<?php

namespace App\Models;

use App\Traits\UsesPrivateid;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use UsesPrivateid;
    
    protected $fillable = ['data', 'description', 'count_options'];
}
