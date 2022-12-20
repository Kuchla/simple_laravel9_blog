<?php

namespace App\Helpers;

use App\Models\Image;
use App\Models\Post;

class PostHelper
{
    public static function getRandomImages()
    {
        return Image::where('imageable_type', Post::class)
            ->inRandomOrder()
            ->limit(9)
            ->pluck('path', 'imageable_id');
    }
}
