<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Brand;

class SearchResult extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name;
    public $selectedbrands = [];
    public $startPrice, $endPrice;
    public $searched;

    public function mount($name)
    {
        $this->name  =  $name;
    }

    public function priceRange($formData)
    {
        $this->startPrice = $formData['priceFrom'];
        $this->endPrice = $formData['priceTo'];
    }
    
    public function render()
    {
        // $results = ;

        return view('livewire.user.search-result',[
            'products' => Product::with('media')->where('name', 'LIKE', '%' . $this->name . '%')
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
