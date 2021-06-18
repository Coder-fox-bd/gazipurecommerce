<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category as Categories;

class Category extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $category;
    public $slug;
    public $startPrice, $endPrice;

    public function priceRange($formData)
    {
        $this->startPrice = $formData['priceFrom'];
        $this->endPrice = $formData['priceTo'];
    }

    public function mount($slug)
    {
        $this->slug  =  $slug;
    }

    public function render()
    {
        $this->category = Categories::where('slug', $this->slug)->where('menu', 1)->first();
        return view('livewire.user.category',[
            'products' => $this->category->products()
                ->when($this->startPrice OR $this->endPrice, function($query){
                    $query->whereBetween('price', [$this->startPrice,$this->endPrice]);
                })->paginate(30),
        ])->extends('user.layouts.user_one');
    }
}
