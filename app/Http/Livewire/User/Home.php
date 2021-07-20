<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;

class Home extends Component
{
    public function render()
    {
        return view('livewire.user.home',[
            'categories' => Category::all(),
            'products' => Product::all(),
            'brands' => Brand::all(),
        ])->extends('user.layouts.user_one');
    }
}
