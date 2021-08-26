<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category as Categories;
use App\Models\Brand;
use App\Models\Product;

class Category extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $category;
    public $slug;
    public $selectedbrands = [];
    public $startPrice, $endPrice;
    public $searched;

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
        $this->category = Categories::where('slug', $this->slug)->first();
        // $products = Product::with('media')->join('category_products', 'products.id', 'category_products.product_id')
        //             ->where('category_products.category_id', $this->category->id)
        //             ->when($this->startPrice OR $this->endPrice, function($query){
        //                 $query->whereBetween('price', [$this->startPrice,$this->endPrice]);
        //             })
        //             ->when($this->selectedbrands, function($query){
        //                 $query->whereIn('brand_id', $this->selectedbrands);
        //             })
        //             ->when($this->searched, function($query){
        //                 $query->where('name', 'LIKE', '%' . $this->searched . '%');
        //             })
        //             ->paginate(30);
        return view('livewire.user.category',[
            'products' => $this->category->products()
                ->when($this->startPrice OR $this->endPrice, function($query){
                    $query->whereBetween('price', [$this->startPrice,$this->endPrice]);
                })
                ->when($this->selectedbrands, function($query){
                    $query->whereIn('brand_id', $this->selectedbrands);
                })
                ->when($this->searched, function($query){
                    $query->where('name', 'LIKE', '%' . $this->searched . '%');
                })
                ->paginate(30),
            'brands' => Brand::all(),
        ])->extends('user.layouts.user_one');
    }
}