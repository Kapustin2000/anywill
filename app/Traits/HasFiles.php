<?php
namespace App\Traits;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

trait HasFiles
{
    protected static function bootHasFiles()
    {
        static::saved(function ($model) {

            if(!$model->files) return;

            $files_files = File::whereIn('id', $model->files)->whereNull('url')->get();

            $model_name = strtolower((new \ReflectionClass($model))->getShortName());

            foreach ($files_files as $file) {

                $file->update(
                    $file->cp($model_name.'/'.($model->private_id ?? $model->id))
                );

            }
        });


        static::deleted(function ($model){

            if(!$model->files) return;

            File::whereIn('id', $model->files)->delete();

            $model_name = strtolower((new \ReflectionClass($model))->getShortName());
            
            Storage::deleteDirectory($model_name.'/'.($model->private_id ?? $model->id));

//            $files_files = File::whereIn('id', $model->files)->get();
//
//            foreach ($files_files as $file) {
//                $file->deleteFile();
//                $file->delete();
//           }
        });
    }
}