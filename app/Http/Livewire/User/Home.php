<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Category;

class Home extends Component
{
    public function render()
    {
        return view('livewire.user.home',[
            'categories' => Category::all(),
        ])->extends('user.layouts.user_one');
    }
}
