<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Product as Item;
use App\Models\Attribute;
use App\Models\Variant;
use App\Models\ProductVariant;
use App\Models\Cart;
use Cart as ShopingCart;

class Product extends Component
{
    public $product, $attributes, $variation, $product_variations;
    public $attribute_price, $variation_price;
    public $related_variants;
    public $buy_now = 0;

    public function mount($slug)
    {
        $this->product = Item::with('media')->where('slug', $slug)->first();
        $this->attributes = Attribute::orderBy('id', 'DESC')->get();

        if (isset($this->product->attributes[0])) {
            $this->product_variations = ProductVariant::where('product_attribute_id', $this->product->attributes[0]->id)->get();
            if (isset( $this->product_variations[0])) {
                $this->variation = Variant::where('id', $this->product_variations[0]->variant_id )->first();
            }
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

    public function buyNow()
    {
        $this->buy_now = 1;
    }

    public function onSubmit($formData)
    {
        switch ($this->buy_now) {
            case '1':
                //check here if the user is authenticated
                if ( ! Auth::user() )
                {
                    session(['link' => url()->previous()]);
                    session()->flash('worning', 'You need to login first!');
                    return redirect(route('login'));
                }
                
                $product = Item::find($formData['id']);
                if (!$product) {
                    session()->flash('warning', 'Something went wrong!');
                }else{
                    // session()->flash('success', 'Item added to cart!');
                    $buy = session()->get('buy');
                    unset($buy[0]);
                    session()->put('buy', $buy);

                    $id = $formData['id'];
                    // add to buy session
                    $buy[0] = [
                        "id" => $id,
                        "name" => $product->name,
                        "attribute" => $formData['attribute'],
                        "variation" => $formData['variation'],
                        "quantity" => $formData['quantity'],
                        "price" => $formData['price'],
                    ];
                    session()->put('buy', $buy);
                    return redirect()->route('checkout');
                }
            case '0':
                // // $this->validate();
                // $product = Item::findOrFail($formData['id']);
                // if (!$product) {
                //     session()->flash('warning', 'Something went wrong!');
                // }else{
                //     // session()->flash('success', 'Item added to cart!');
                //     //check here if the user is authenticated
                //     if ( ! Auth::user() )
                //     {
                //         session(['link' => url()->previous()]);
                //         session()->flash('worning', 'You need to login first!');
                //         return redirect(route('login'));
                //     }
                //     $id = $formData['id'];
                //     $cart = Cart::where('user_id', Auth::user()->id)->get()->toArray();
                //     // if cart is empty then this the first product
                //     if (!$cart) {
                //         $cart =  new Cart;
                //         $cart->user_id = Auth::user()->id;
                //         $cart->product_id = $formData['id'];
                //         $cart->product_attribute = $formData['attribute'];
                //         $cart->product_variant = $formData['variation'];
                //         $cart->quantity = $formData['quantity'];
                //         $cart->price = $formData['price'];

                //         $cart->save();
                //         $this->emit('UpdateCart');
                //         session()->flash('success', 'Item added to cart!');
                //     }else{
                //         // if cart not empty then check if this product exist then increment quantity
                //         $cart_arr = array_column($cart, 'id', 'product_id');
                //         if (isset($cart_arr[$formData['id']])) {
                //             $cart_product = Cart::where('id', $cart_arr[$formData['id']])->first();
                //             $cart_product->product_attribute = $formData['attribute'];
                //             $cart_product->product_variant = $formData['variation'];
                //             $cart_product->quantity = $formData['quantity'];
                //             $cart_product->price = $formData['price'];

                //             $cart_product->update();
                //             $this->emit('UpdateCart');
                //             session()->flash('success', 'Cart Updated!');
                //         }else{
                //             // if item not exist in cart then add to cart with quantity
                //             $cart =  new Cart;
                //             $cart->user_id = Auth::user()->id;
                //             $cart->product_id = $formData['id'];
                //             $cart->product_attribute = $formData['attribute'];
                //             $cart->product_variant = $formData['variation'];
                //             $cart->quantity = $formData['quantity'];
                //             $cart->price = $formData['price'];
            
                //             $cart->save();
                //             $this->emit('UpdateCart');
                //             session()->flash('success', 'Item added to cart!');
                //         }
                //     }
                // }
                $product = Item::find($formData['id']);
                ShopingCart::add($product->id, $product->name , $formData['price'], $formData['quantity'], [$formData['attribute'], $formData['variation']], $product->getFirstMediaUrl('products'),  $product->slug);
                $this->emit('UpdateCart');
                session()->flash('success', 'Item added to cart!');
                break;
        }
    }

    public function render()
    {
        return view('livewire.user.product')
            ->extends('user.layouts.user_one');
    }
}
