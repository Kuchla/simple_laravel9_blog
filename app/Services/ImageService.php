<?php

namespace App\Services;

use App\Helpers\StorageHelper;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class ImageService
{
    public static function save($file, $model)
    {
        DB::beginTransaction();

        try {
            $newImage = new Image([
                'name' => $file->hashName(),
                'path' => StorageHelper::saveImage($file, $model)
            ]);

            $newImage->imageable()->associate($model);
            $newImage->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            session()->flash('message', [
                'text' => "Error - {$th->getMessage()}, image was not created.",
                'type' => 'error'
            ]);
        }
    }

    public static function update($file, $model)
    {
        if ($file) {
            DB::beginTransaction();

            try {
                StorageHelper::deleteImage($model);

                $model->image->update([
                    'name' => $file->hashName(),
                    'path' => StorageHelper::saveImage($file, $model)
                ]);

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();

                session()->flash('message', [
                    'text' => "Error - {$th->getMessage()}, image was not updated.",
                    'type' => 'error'
                ]);
            }
        }
    }
}
