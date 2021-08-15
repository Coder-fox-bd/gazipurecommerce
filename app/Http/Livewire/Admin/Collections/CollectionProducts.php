<?php

namespace App\Http\Livewire\Admin\Collections;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Collection;

class CollectionProducts extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $collectionId;

    public function detach($productId)
    {

        if (!$this->collectionId) {
            $collection = Collection::where('status', 1)->with('products')->first();
        }else{
            $collection= Collection::where('id', $this->collectionId)->with('products')->first();
        }
        $collection->products()->detach($productId);
    }

    public function render()
    {
        if (!$this->collectionId) {
            $collection = Collection::where('status', 1)->with('products')->first();
        }else{
            $collection = Collection::where('id', $this->collectionId)->with('products')->first();
        }
        $collections = Collection::where('status', 1)->get();
        return view('livewire.admin.collections.collection-products',[
            'products' => $collection->products,
            'collections' => $collections,
        ])->extends('admin.layout.base');;
    }
}
