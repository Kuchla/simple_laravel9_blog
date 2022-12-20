<?php

namespace App\Http\Livewire;

use App\Helpers\PostHelper;
use App\Models\Category;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class HomeComponent extends Component
{
    use WithPagination;

    public $categoryIdSelected;
    public $categories;

    public function render()
    {
        return view('blog.home', [
            'posts' => $this->getPosts($this->categoryIdSelected)
        ])->layoutData([
            'categories' => $this->categories,
            'categoryIdSelected' => $this->categoryIdSelected,
            'randomImages' => PostHelper::getRandomImages()
        ]);
    }

    private function getPosts($category_id)
    {
        return Post::when($category_id, function ($q) use ($category_id) {
            return $q->where('category_id', $category_id);
        }, function ($q) {
            return $q;
        })->paginate(3);
    }

    public function mount(Category $category)
    {
        $this->categoryIdSelected = $category->id;
        $this->categories = Category::all();
    }

    public function paginationView()
    {
        return 'vendor.livewire.custom-tailwind';
    }
}
