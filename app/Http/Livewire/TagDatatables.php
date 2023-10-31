<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class TagDatatables extends LivewireDatatable
{
    public $model = Tag::class;
    public $tag = ['active' => false];
    public $buttonsSlot = 'tag.create';
    public $beforeTableSlot = 'layouts.session-message';

    protected $rules = [
        'tag.name' => 'required|min:2',
        'tag.active' => 'boolean',
    ];

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->sortBy('id'),

            Column::name('name')
                ->label('Name')
                ->searchable()
                ->enableSummary(),

            BooleanColumn::name('active')
                ->label('Active'),

            DateColumn::name('created_at')
                ->label('Creation Date'),

            Column::callback(['id', 'name'], function ($id, $name) {
                return view('tag.datatable-actions', ['id' => $id, 'name' => $name]);
            })->unsortable()
        ];
    }

    public function show($id)
    {
        $this->tag = Tag::findOrFail($id);
    }

    public function edit($id)
    {
        $this->tag = Tag::findOrFail($id);
    }

    public function update(Tag $tag)
    {

        $this->validate();

        try {
            $tag->update([
                'name' => $this->tag->name,
                'active' => $this->tag->active,
                'user_id' => Auth::user()->id
            ]);

            session()->flash('message', [
                'text' => "Tag {$tag->id} successfully updated.",
                'type' => 'success'
            ]);
        } catch (\Throwable $th) {
            session()->flash('message', [
                'text' => "Error - {$th->getMessage()}, tag {$tag->id} was not updated.",
                'type' => 'error'
            ]);
        }

        $this->resetModal();
    }

    public function save()
    {
        $this->validate();

        try {
            $tag = Tag::create([
                'name' => $this->tag['name'],
                'active' => $this->tag['active'],
                'user_id' => Auth::user()->id
            ]);

            session()->flash('message', [
                'text' => "Tag {$tag->id} successfully created.",
                'type' => 'success'
            ]);
        } catch (\Throwable $th) {
            session()->flash('message', [
                'text' => "Error - {$th->getMessage()}, tag was not creatated.",
                'type' => 'error'
            ]);
        }

        $this->resetModal();
    }

    public function delete($id)
    {
        try {
            $this->model::destroy($id);

            session()->flash('message', [
                'text' => "Tag {$id} successfully deleted.",
                'type' => 'success'
            ]);
        } catch (\Throwable $th) {
            session()->flash('message', [
                'text' => "Error - {$th->getMessage()}, Tag {$id} was not deleted.",
                'type' => 'error'
            ]);
        }
    }

    public function resetModal()
    {
        $this->resetValidation();
        $this->reset('tag');
        $this->dispatchBrowserEvent('saved');
    }
}
