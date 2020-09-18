<?php
namespace App\Traits;
use App\Models\Cemetery;
use App\Models\Media;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

trait HasMedia
{
    protected static function bootHasMedia()
    {
        static::saved(function ($model) {

            $media_files = Media::whereIn('id', $model->media)->get();

            $model_name = strtolower((new \ReflectionClass($model))->getShortName());

            foreach ($media_files as $media) {

                if($media->url) continue;

                $media->update(
                    $media->cp($model_name.'/'.$model->id)
                );

            }
        });


        static::deleted(function ($model){
            Media::whereIn('id', $model->media)->delete();
        });
    }
}