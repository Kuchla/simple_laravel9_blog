<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class ImageFactory extends Factory
{
    protected $imageableId = 0;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->imageableId++;

        return [
            'name' => 'image-default.jpg',
            'path' => 'images/image-default.jpg',
            'imageable_type' => 'App\Models\Post',
            'imageable_id' => $this->imageableId
        ];
    }
}
