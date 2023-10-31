<?php

namespace App\Http\Livewire;

use App\Helpers\PostHelper;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class HomeComponent extends Component
{
    use WithPagination;

    public $categoryIdSelected = false;
    public $tagIdSelected = false;
    public $categories;
    public $tags;
    protected $paginationTheme = 'custom-tailwind';

    public function render()
    {
        return view('blog.home', [
            'posts' => $this->getPosts($this->categoryIdSelected, $this->tagIdSelected)
        ])->layoutData([
            'categories' => $this->categories,
            'categoryIdSelected' => $this->categoryIdSelected,
            'randomImages' => PostHelper::getRandomImages(),
            'tagIdSelected' => $this->tagIdSelected
        ]);
    }

    private function getPosts($category_id, $tag_id)
    {
        return Post::when($category_id, function ($q) use ($category_id) {
            return $q->where('category_id', $category_id);
        }, function ($q) {
            return $q;
        })->when($tag_id, function ($q) use ($tag_id) {
            return $q->whereHas('tags', function ($q) use ($tag_id) {
                $q->where('tags.id', $tag_id);
            });
        }, function ($q) {
            return $q;
        })->paginate(3);
    }

    public function mount($category = 0, $tag = 0)
    {
        $this->categoryIdSelected = $category;
        $this->tagIdSelected = $tag;
        $this->categories = Category::all();
        $this->tags = Tag::all();
    }

    public function paginationView()
    {
        return 'vendor.livewire.custom-tailwind';
    }
}
