<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Brand as BrandModel;

class Brand extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $brand;
    public $slug;
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
        $this->brand = BrandModel::where('slug', $this->slug)->first();
        return view('livewire.user.brand',[
            'products' => $this->brand->products()
                ->when($this->startPrice OR $this->endPrice, function($query){
                    $query->whereBetween('price', [$this->startPrice,$this->endPrice]);
                })
                ->when($this->searched, function($query){
                    $query->where('name', 'LIKE', '%' . $this->searched . '%');
                })
                ->paginate(30),
        ])->extends('user.layouts.user_one');
    }
}
