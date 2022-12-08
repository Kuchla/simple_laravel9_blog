<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Image::factory()->count(3)->sequence(fn ($sequence) => [
            'imageable_id' => $sequence->index + 1
        ])->create([
            'imageable_type' => Post::class,
        ]);

        Image::factory()->count(3)->sequence(fn ($sequence) => [
            'imageable_id' => $sequence->index + 1
        ])->create([
            'imageable_type' => User::class,
        ]);
    }
}
