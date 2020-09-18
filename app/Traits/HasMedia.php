<?php
namespace App\Traits;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

trait HasMedia
{
    protected static function bootHasMedia()
    {
        static::saving(function ($model) {
            Log::debug($model->id);
        });
    }
}