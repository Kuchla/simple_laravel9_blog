<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class StorageHelper
{
    public static function saveImage($file, $model)
    {
        return 'storage/' . Storage::disk('public')->put('images/' . $model->getTable(), $file);
    }

    public static function deleteImage($model)
    {
        Storage::delete('public/images/' . $model->getTable() . '/' . $model->image->name);
    }
}
