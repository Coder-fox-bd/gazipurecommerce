<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Cart as ShopingCart;

class Cart extends Component
{
    protected $listeners = ['UpdateCart' => 'render'];

    public function render()
    {
        // if (Auth::user()) {
        //     $cart = Auth::user()->cart;
        //     $count = $cart->count();
        // }else{
        //     $count = 0;
        // }
        return view('livewire.user.cart',[
            'cart_count' =>  ShopingCart::getTotalQuantity(),
        ]);
    }
}
