<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class CategoryDatatables extends LivewireDatatable
{
    public $model = Category::class;
    public $category = ['active' => false];
    public $buttonsSlot = 'category.create';
    public $beforeTableSlot = 'layouts.session-message';

    protected $rules = [
        'category.name' => 'required|min:2',
        'category.active' => 'boolean',
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
                return view('category.datatable-actions', ['id' => $id, 'name' => $name]);
            })->unsortable()
        ];
    }

    public function show($id)
    {
        $this->category = Category::findOrFail($id);
    }

    public function edit($id)
    {
        $this->category = Category::findOrFail($id);
    }

    public function update(Category $category)
    {
        $this->validate();

        try {
            $category->update([
                'name' => $this->category->name,
                'active' => $this->category->active,
                'user_id' => Auth::user()->id
            ]);

            session()->flash('message', [
                'text' => "Category {$category->id} successfully updated.",
                'type' => 'success'
            ]);
        } catch (\Throwable $th) {
            session()->flash('message', [
                'text' => "Error - {$th->getMessage()}, category {$category->id} was not updated.",
                'type' => 'error'
            ]);
        }

        $this->resetModal();
    }

    public function save()
    {
        $this->validate();

        try {
            $category = Category::create([
                'name' => $this->category['name'],
                'active' => $this->category['active'],
                'user_id' => Auth::user()->id
            ]);

            session()->flash('message', [
                'text' => "Category {$category->id} successfully created.",
                'type' => 'success'
            ]);
        } catch (\Throwable $th) {
            session()->flash('message', [
                'text' => "Error - {$th->getMessage()}, category was not creatated.",
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
                'text' => "Category {$id} successfully deleted.",
                'type' => 'success'
            ]);
        } catch (\Throwable $th) {
            session()->flash('message', [
                'text' => "Error - {$th->getMessage()}, Category {$id} was not deleted.",
                'type' => 'error'
            ]);
        }
    }

    public function resetModal()
    {
        $this->resetValidation();
        $this->reset('category');
        $this->dispatchBrowserEvent('saved');
    }
}
