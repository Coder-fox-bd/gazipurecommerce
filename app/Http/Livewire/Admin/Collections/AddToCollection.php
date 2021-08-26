<?php

namespace App\Http\Livewire\Admin\Collections;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Collection;
use App\Models\Product;

class AddToCollection extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $collectionId;

    public function attatch($productId)
    {
        $this->validate([
            'collectionId'      =>  'required',
        ]);

        $collection= Collection::where('id', $this->collectionId)->with('products')->first();
        $collection_product = $collection->products->toArray();
        $product_arr = array_column($collection_product, 'id', 'id');
        if (isset($product_arr[$productId])) {
            session()->flash('warning', 'Product exist to collection!');
        }else{
            $collection->products()->attach($productId);
        }
    }

    public function render()
    {
        $products = Product::with('brand')->where('name', 'LIKE', '%' . $this->search . '%')->paginate(10);
        $collections = Collection::where('status', 1)->get();
        return view('livewire.admin.collections.add-to-collection',[
            'products' => $products,
            'collections' => $collections,
        ])->extends('admin.layout.base');
    }
}
