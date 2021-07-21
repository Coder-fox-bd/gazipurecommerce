<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Product as Item;
use App\Models\Attribute;
use App\Models\Variant;
use App\Models\ProductVariant;
use App\Models\Cart;

class Product extends Component
{
    public $product, $attributes, $variation, $product_variations;
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

    public function addToAttributes($id, $value, $price)
    {
        $this->attribute_price = $price;
        $this->related_variants = ProductVariant::where('product_attribute_id', $id)->get();
        $this->attrib = $value;
    }

    public function addToVariations($name, $price)
    {
        $this->variation_price = $price;
        $this->variant = $name;
    }

    public function addToCart($formData)
    {
        // $this->validate();
        $product = Item::find($formData['id']);
        if (!$product) {
            session()->flash('warning', 'Something went wrong!');
        }else{
            // session()->flash('success', 'Item added to cart!');
             //check here if the user is authenticated
            if ( ! Auth::user() )
            {
                session()->flash('worning', 'You need to login first!');
                return redirect(route('login'));
            }
            $id = $formData['id'];
            $cart = Cart::where('user_id', Auth::user()->id)->get()->toArray();
            // if cart is empty then this the first product
            if (!$cart) {
                $cart =  new Cart;
                $cart->user_id = Auth::user()->id;
                $cart->product_id = $formData['id'];
                $cart->product_attribute = $formData['attribute'];
                $cart->product_variant = $formData['variation'];
                $cart->quantity = $formData['quantity'];
                $cart->price = $formData['price'];

                $cart->save();
                $this->emit('UpdateCart');
                session()->flash('success', 'Item added to cart!');
            }else{
                // if cart not empty then check if this product exist then increment quantity
                $cart_arr = array_column($cart, 'id', 'product_id');
                if (isset($cart_arr[$formData['id']])) {
                    $cart_product = Cart::where('id', $cart_arr[$formData['id']])->first();
                    $cart_product->product_attribute = $formData['attribute'];
                    $cart_product->product_variant = $formData['variation'];
                    $cart_product->quantity = $formData['quantity'];
                    $cart_product->price = $formData['price'];

                    $cart_product->update();
                    $this->emit('UpdateCart');
                    session()->flash('success', 'Cart Updated!');
                }else{
                    // if item not exist in cart then add to cart with quantity
                    $cart =  new Cart;
                    $cart->user_id = Auth::user()->id;
                    $cart->product_id = $formData['id'];
                    $cart->product_attribute = $formData['attribute'];
                    $cart->product_variant = $formData['variation'];
                    $cart->quantity = $formData['quantity'];
                    $cart->price = $formData['price'];
    
                    $cart->save();
                    $this->emit('UpdateCart');
                    session()->flash('success', 'Item added to cart!');
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.user.product')
            ->extends('user.layouts.user_one');
    }
}
