<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Collection;
use App\Models\Product;
use App\Models\Carousel;


class UrlGeneratior extends Component
{
    public $search;
    public $collectionSlug;
    public $productSlug;
    public $link;
    public $message;

    public function resetWire()
    {
        $this->reset();
    }

    public function save($formData)
    {
        $carousel = Carousel::findOrFail($formData['carouselId']);
        if (strlen($this->link) < 1) {
            $this->message = "Please select a product or a collection!";
        }else{
            $carousel->offer_url = $this->link;
            $carousel->update();
            session()->flash('success', 'Linked successfully!');
        }
    }
    
    public function render()
    {
        $results = [];

        if (strlen($this->search) >= 1) {
            $results = Product::where('name', 'LIKE', '%' . $this->search . '%')->limit(3)->get();
        }

        if (strlen($this->collectionSlug) >= 1) {
            $this->link = $this->collectionSlug;
        }elseif(strlen($this->productSlug) >= 1) {
            $this->link = $this->productSlug;
        }

        return view('livewire.admin.url-generatior',[
            'products' => $results,
            'collections' => Collection::all(),
            'url' => $this->link,
        ]);
    }
}
