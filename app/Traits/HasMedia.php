<?php
namespace App\Traits;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;

trait HasMedia
{
    protected static function bootHasMedia()
    {
        static::saved(function ($model) {

            if(!$model->media) return;

            $media_files = Media::whereIn('id', $model->media)->whereNull('url')->get();

            $model_name = strtolower((new \ReflectionClass($model))->getShortName());

            foreach ($media_files as $media) {

                $media->update(
                    $media->cp($model_name.'/'.($model->private_id ?? $model->id))
                );

            }
        });


        static::deleted(function ($model){

            if(!$model->media) return;

            Media::whereIn('id', $model->media)->delete();

            $model_name = strtolower((new \ReflectionClass($model))->getShortName());
            
            Storage::deleteDirectory($model_name.'/'.($model->private_id ?? $model->id));

//            $media_files = Media::whereIn('id', $model->media)->get();
//
//            foreach ($media_files as $media) {
//                $media->deleteFile();
//                $media->delete();
//           }
        });
    }
}