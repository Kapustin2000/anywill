<?php

namespace App\Models;

use App\Traits\UsesPrivateid;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use UsesPrivateid;

    protected $casts = [
        'details' => 'array'
    ];

    const TYPES = [
        'replenishment',
        'transfer',
        'output'
    ];

    const PROVIDERS = [
       'other',
       'stripe',
       'manual',
       'bank'
    ];

    public $with = ['from_user', 'to_user'];
    protected $fillable = ['from_user_id', 'to_user_id', 'amount','provider','type', 'details', 'description'];
    protected $hidden = ['from_user_id', 'to_user_id'];

    public function from_user()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function to_user()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
    
    public function type()
    {
        return $this->belongsTo(TransactionType::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'owner');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'owner');
    }
}
