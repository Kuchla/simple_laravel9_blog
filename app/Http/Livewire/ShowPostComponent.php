<?php

namespace App\Http\Livewire;

use App\Helpers\PostHelper;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Component;

class ShowPostComponent extends Component
{
    public $post;
    public $tags;

    public function render()
    {
        return view('blog.post', [
            'posts' =>  $this->post,
        ])->layoutData([
            'categories' => Category::all(),
            'categoryIdSelected' =>  $this->post->category_id,
            'randomImages' => PostHelper::getRandomImages()
        ]);
    }

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->tags = Tag::all();
    }
}
