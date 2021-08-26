<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Brand;

class Shop extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $selectedbrands = [];
    public $startPrice, $endPrice;
    public $searched;

    public function priceRange($formData)
    {
        $this->startPrice = $formData['priceFrom'];
        $this->endPrice = $formData['priceTo'];
    }

    public function render()
    {
        return view('livewire.user.shop',[
            'products' => Product::with('media')
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
