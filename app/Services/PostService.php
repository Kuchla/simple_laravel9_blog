<?php

namespace App\Services;

use App\Helpers\StorageHelper;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostService
{
    public static function update($post, $attributes)
    {
        DB::beginTransaction();

        try {
            $post->update([
                'title' => $attributes['title'],
                'active' => $attributes['active'],
                'description' => $attributes['description'],
                'text' => $attributes['text'],
                'category_id' => $attributes['category_id'],
                'user_id' => Auth::user()->id
            ]);
            DB::commit();

            session()->flash('message', [
                'text' => "Post {$post->id} successfully updated.",
                'type' => 'success'
            ]);
        } catch (\Throwable $th) {
            DB::rollback();

            session()->flash('message', [
                'text' => "Error - {$th->getMessage()}, post {$post->id} was not updated.",
                'type' => 'error'
            ]);
        }

        return true;
    }

    public static function save($attributes)
    {
        DB::beginTransaction();

        try {
            $post = Post::create([
                'title' => $attributes['title'],
                'active' => $attributes['active'],
                'description' => $attributes['description'],
                'text' => $attributes['text'],
                'category_id' => $attributes['category_id'],
                'user_id' => Auth::user()->id
            ]);
            DB::commit();

            session()->flash('message', [
                'text' => "Post {$post->id} successfully created.",
                'type' => 'success'
            ]);
        } catch (\Throwable $th) {
            DB::rollback();

            session()->flash('message', [
                'text' => "Error - {$th->getMessage()}, post was not creatated.",
                'type' => 'error'
            ]);
        }

        return $post;
    }

    public static function delete($id)
    {
        DB::beginTransaction();

        try {
            $post = Post::findOrFail($id);
            StorageHelper::deleteImage($post);
            $post->image->delete();
            $post->delete();

            DB::commit();

            session()->flash('message', [
                'text' => "Post {$post->id} successfully deleted.",
                'type' => 'success'
            ]);
        } catch (\Throwable $th) {
            DB::rollback();

            session()->flash('message', [
                'text' => "Error - {$th->getMessage()}, Post {$post->id} was not deleted.",
                'type' => 'error'
            ]);
        }
        return true;
    }
}
