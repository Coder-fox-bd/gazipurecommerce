<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Carousel;
use App\Models\DailyHome;

class Home extends Component
{
    public function render()
    {
        $new = DailyHome::where('name', 'new')->first();
        $recomended = DailyHome::where('name', 'recomended')->first();
        return view('livewire.user.home',[
            'categories' => Category::with('media')->get(),
            'new' => $new->products()->with('media')->get(),
            'recomended' => $recomended->products()->with('media')->get(),
            'brands' => Brand::with('media')->get(),
            'carousel' => Carousel::where('mobile_image', 0)->get(),
        ])->extends('user.layouts.user_one');
    }
}
