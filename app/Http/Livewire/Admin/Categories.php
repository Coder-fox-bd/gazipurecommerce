<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

class Categories extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name;
    public $category_id;
    public $url;
    public $deleteId = '';
    public $updateMode = false;

    protected $rules = [
        'name' => 'required|min:2|max:255|string',
        'category_id' => 'sometimes|nullable|numeric'
    ];

    public function cancel()
    {
        $this->updateMode = false;
        $this->reset();
    }

    public function store()
    {
        $validatedData = $this->validate();
        $category = Category::create($validatedData);
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
        if($this->deleteId){
            Category::find($this->deleteId)->delete();
            session()->flash('success', 'Users Deleted Successfully.');
        }
    }

    public function render()
    {
        $categories = Category::with('children')->whereNull('category_id')->paginate(10);
        return view('livewire.admin.categories', [
            'categories' => $categories,
        ]);
    }
}
