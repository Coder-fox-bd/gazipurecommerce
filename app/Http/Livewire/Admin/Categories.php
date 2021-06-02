<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Categories extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name;
    public $description;
    public $category_id;
    public $image;
    public $featured;
    public $menu;
    public $url;
    public $deleteId = '';
    public $updateMode = false;

    protected $rules = [
        'name' => 'required|min:2|max:255|string',
        'category_id' => 'sometimes|nullable|numeric',
        'image'     =>  'nullable|mimes:jpg,jpeg,png|max:1000'
    ];

    public function cancel()
    {
        $this->updateMode = false;
        $this->reset();
    }

    public function store()
    {
        $this->validate();

        if ($this->image) {
            $this->image = $this->image->store('categories', 'public');;
        }

        $featured = $this->featured ? 1 : 0;
        $menu = $this->menu ? 1 : 0;

        $category = Category::create([
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'featured' => $featured,
            'menu' => $menu,
            'image' => $this->image,
        ]);

        if (!$category) {
            session()->flash('error', "Somethign went wrong!");
        }
        session()->flash('success', "You have successfully added a Category!");
        $this->reset();
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $category = Category::find($id);
        $this->category_id = $category->id;
        $this->name = $category->name;    
    }

    public function update()
    {
        $validatedData = $this->validate([
            'name'  => 'required|min:2|max:255|string'
        ]);
        $category = Category::find($this->category_id);
        $category->update($validatedData);
        $this->updateMode = false;
        session()->flash('success', 'Users Updated Successfully.');
        $this->reset();
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {
        $category = Category::findOrFail($this->deleteId);
        if ($category->image) {
            if(Storage::delete('public/'.$category->image)) {
                $category->delete();
                session()->flash('warning', 'Category has been deleted!');
            }
        }else {
            $category->delete();
            session()->flash('warning', 'Category has been deleted!');
        }
    }

    public function render()
    {
        $categories = Category::with('children')->whereNull('category_id')->paginate(10);
        return view('livewire.admin.categories', [
            'categories' => $categories,
        ])->extends('admin.layout.base');
    }
}
