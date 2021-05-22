<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;

class AddProduct extends Component
{
    public function render()
    {
        $categories = Category::with('children')->whereNull('category_id')->get();
        return view('livewire.admin.add-product', [
            'categories' => $categories,
        ])->extends('admin.layout.base');
    }
}
