<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'text', 'user_id', 'category_id', 'active'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id')->withTimestamps();
    }

    public function next()
    {
        return $this->where('id', '>', $this->id)
            ->where('category_id', $this->category_id)
            ->orderBy('id', 'asc')
            ->first();
    }

    public function previous()
    {
        return Post::where('id', '<', $this->id)
            ->where('category_id', $this->category_id)
            ->orderBy('id', 'desc')
            ->first();
    }
}
