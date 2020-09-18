<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Media extends Model
{
    protected $fillable = ['name','meta','path'];
    public $timestamps = false;
    protected $casts = [
        'meta' => 'array',
    ];


    public function cp($path, $prefix)
    {
        $dir = preg_replace("/^\/|\/$/", '', $path);
        $prefix = preg_replace("/_$/", '', $prefix);
        $prefix = preg_replace("/\//", '', $prefix);

        // generate random name
        $name = $prefix . '_' . Str::random(64) . '.' . $this->meta['ext'];
        $path = $dir . '/' . $name;

        $content = Storage::get($this->path);
        Storage::put($path, $content);

        return [
            'path' => $dir . '/' . $name,
            'url' => Storage::url($path),
            'name' => $name,
        ];
    }


    public function deleteFile()
    {
        Storage::delete($this->path);
    }
}
