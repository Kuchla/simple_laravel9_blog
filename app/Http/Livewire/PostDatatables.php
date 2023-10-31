<?php

namespace App\Http\Livewire;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Services\ImageService;
use App\Services\PostService;

use Illuminate\Http\Request as HttpRequest;

use Livewire\WithFileUploads;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class PostDatatables extends LivewireDatatable
{
    use WithFileUploads;

    public $post = ['active' => false];
    public $buttonsSlot = 'post.create';
    public $beforeTableSlot = 'layouts.session-message';
    public $image = false;
    public $category;
    public $formAction;
    public $disabledInputs;
    public $selectedTags;
    public $tags;
    public $tag;

    protected function rules()
    {
        return (new PostRequest($this->formAction))->rules();
    }

    public function builder()
    {
        $this->category = Category::all();
        $this->tags = Tag::all();
        return Post::query();
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->sortBy('id'),

            Column::name('title')
                ->label('Title')
                ->searchable(),

            Column::name('description')
                ->label('Description')
                ->truncate(30),

            Column::name('category.name')
                ->label('Category')
                ->searchable(),

            BooleanColumn::name('active')
                ->label('Active'),

            Column::name('user.name')
                ->label('Author')
                ->searchable(),

            DateColumn::name('created_at')
                ->label('Creation Date'),

            Column::callback(['id', 'title'], function ($id, $title) {
                return view('post.datatable-actions', ['id' => $id, 'title' => $title]);
            })->unsortable()
        ];
    }

    public function create()
    {
        $this->formAction = 'create';

        $this->dispatchBrowserEvent('create_ckeditor', [
            'class_name' => '.' . $this->formAction,
            'selected_tags' => $this->nome, 'tag_id' => '#tagscreate'
        ]);

        $this->disabledInputs = false;
    }

    public function show($id)
    {
        $this->formAction = 'show';

        $this->disabledInputs = true;
        $this->post = Post::findOrFail($id);
        $this->selectedTags = $this->post->tags->pluck('id');

        $this->dispatchBrowserEvent('create_ckeditor', [
            'class_name' => '.' . $this->formAction . '-' . $id,
            'tag_id' => '#tagsshow-' . $id,
            'selected_tags' => $this->selectedTags
        ]);
    }

    public function edit($id)
    {
        $this->formAction = 'edit';

        $this->disabledInputs = false;
        $this->post = Post::findOrFail($id);
        $this->selectedTags = $this->post->tags->pluck('id');

        $this->dispatchBrowserEvent('create_ckeditor', [
            'class_name' => '.' . $this->formAction . '-' . $id,
            'tag_id' => '#tagsedit-' . $id,
            'selected_tags' => $this->selectedTags
        ]);
    }

    public function update(Post $post, HttpRequest $r)
    {
        $this->validate();

        PostService::update($post, $this->post->getAttributes());
        ImageService::update($this->image, $post);
        $post->tags()->sync($this->tag);

        $this->resetModal();
    }

    public function save()
    {
        $this->validate();

        $post = PostService::save($this->post);
        ImageService::save($this->image, $post);
        $post->tags()->sync($this->tag);

        $this->resetModal();
    }

    public function delete($id)
    {
        PostService::delete($id);
    }

    public function resetModal()
    {
        $this->resetValidation();
        $this->reset('post');
        $this->reset('image');
        $this->dispatchBrowserEvent('saved');
    }
}
