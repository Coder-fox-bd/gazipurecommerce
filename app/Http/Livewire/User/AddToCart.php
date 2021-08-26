<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
// use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductVariant;
// use App\Models\Cart;
use Cart;

class AddToCart extends Component
{
    protected $listeners = ['addCartEvent' => 'add'];
    public $product_price;

    public function add($id)
    {
        // if ( ! Auth::user() )
        // {
        //     session(['link' => url()->previous()]);
        //     session()->flash('worning', 'You need to login first!');
        //     return redirect(route('login'));
        // }
        $product = Product::findOrFail($id);

        if ( $attribute = ProductAttribute::where('product_id', $product->id)->first() ) {
            $attribute_price = $attribute->price;
            $attribute_value = $attribute->value;
        } else {
            $attribute_price = 0;
            $attribute_value = null;
        }

        if ( $variation = ProductVariant::where('product_id', $product->id)->first() ) {
            $variation_price = $variation->price;
            $variation_value = $variation->value;
        } else {
            $variation_price = 0;
            $variation_value = null;
        }

        if ($variation_price > 0) {
                $product_price = $variation_price;
        }elseif ($attribute_price > 0) {
                $product_price = $attribute_price;
        }elseif ($product->special_price) {
            $product_price = $product->special_price;
        }else {
            $product_price = $product->price;
        }

        Cart::add($product->id, $product->name , $product_price, 1, [$attribute_value, $variation_value], $product->getFirstMediaUrl('products'),  $product->slug);
        $this->emit('UpdateCart');
        // $id = $product->id;
        // $cart = Cart::where('user_id', Auth::user()->id)->get()->toArray();
        // // if cart is empty then this the first product
        // if (!$cart) {
        //     $cart =  new Cart;
        //     $cart->user_id = Auth::user()->id;
        //     $cart->product_id = $product->id;
        //     $cart->product_attribute = $attribute_value;
        //     $cart->product_variant = $variation_value;
        //     $cart->quantity = 1;
        //     $cart->price = $product_price;

        //     $cart->save();
        //     $this->emit('UpdateCart');
        //     session()->flash('success', 'Item added to cart!');
        // }else{
        //     // if cart not empty then check if this product exist then increment quantity
        //     $cart_arr = array_column($cart, 'id', 'product_id');
        //     if (isset($cart_arr[$product->id])) {
        //         $cart_product = Cart::where('id', $cart_arr[$product->id])->first();
        //         $cart_product->product_attribute = $attribute_value;
        //         $cart_product->product_variant = $variation_value;
        //         $cart_product->quantity = 1;
        //         $cart_product->price = $product_price;

        //         $cart_product->update();
        //         $this->emit('UpdateCart');
        //         session()->flash('success', 'Cart Updated!');
        //     }else{
        //         // if item not exist in cart then add to cart with quantity
        //         $cart =  new Cart;
        //         $cart->user_id = Auth::user()->id;
        //         $cart->product_id = $product->id;
        //         $cart->product_attribute = $attribute_value;
        //         $cart->product_variant = $variation_value;
        //         $cart->quantity = 1;
        //         $cart->price = $product_price;

        //         $cart->save();
        //         $this->emit('UpdateCart');
        //         session()->flash('success', 'Item added to cart!');
        //     }
        // }
    }

    public function render()
    {
        return view('livewire.user.add-to-cart');
    }
}
