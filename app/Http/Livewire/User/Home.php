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
        $categories = cache()->remember('home_categories', 60*60*24, function () {
                        return Category::with('media')->get();
                    });
        $brands = cache()->remember('home_brands', 60*60*24, function () {
                        return Brand::with('media')->get();
                    });
        $new_products = cache()->remember('new_p', 60*60*24, function () {
                            $new = DailyHome::where('name', 'new')->first();
                            return $new->products()->with('media')->get();
                        });
        $recomended_products = cache()->remember('recomended_p', 60*60*24, function () {
                                $recomended = DailyHome::where('name', 'recomended')->first();
                                return $recomended->products()->with('media')->get();
                            });
        $carousel = cache()->remember('carousel', 60*60*24, function () {
                                return Carousel::where('mobile_image', 0)->get();
                            });
        return view('livewire.user.home',[
            'categories' => $categories,
            'new' => $new_products,
            'recomended' => $recomended_products,
            'brands' => $brands,
            'carousel' =>  $carousel,
        ])->extends('user.layouts.user_one');
    }
}
