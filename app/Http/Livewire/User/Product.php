<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Product as Item;
use App\Models\Attribute;
use App\Models\Variant;
use App\Models\ProductVariant;

class Product extends Component
{
    public $product, $attributes, $variation, $product_variations;
    public $checked_attributes, $checked_variations, $quantity, $price;
    public $attribute_price, $variation_price;
    public $related_variants;


    public function mount($slug)
    {
        $this->product = Item::where('slug', $slug)->first();
        $this->attributes = Attribute::orderBy('id', 'DESC')->get();

        if (isset($this->product->attributes[0])) {
            $this->product_variations = ProductVariant::where('product_attribute_id', $this->product->attributes[0]->id)->get();
            $this->variation = Variant::where('id', $this->product_variations[0]->variant_id )->first();
        }
    }

    public function addToAttributes($id, $price)
    {
        $this->attribute_price = $price;
        $this->related_variants = ProductVariant::where('product_attribute_id', $id)->get();
    }

    public function addToVariations($price)
    {
        $this->variation_price = $price;
    }

    public function addToCart($id)
    {
        
        $product = Item::find($id);
        $cart = session()->get('cart');
        $this->validate([
            "checked_attributes" => 'required',
            "checked_variations" => 'required',
            "quantity" => 'required',
            "price" =>  'required',
        ]);
        // if cart is empty then this the first product
        // if (!$cart) {
        //     $cart = [
        //         $id => [
        //             "name" => $product->name,
        //             "attribute" =>
        //             "variation" =>
        //             "quantity" => 1,
        //             "price" => $product->price,
        //         ]
        //     ]
        // }
    }

    public function render()
    {
        return view('livewire.user.product')
            ->extends('user.layouts.user_one');
    }
}
