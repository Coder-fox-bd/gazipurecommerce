<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class ShopingCart extends Component
{
    public function render()
    {
        return view('livewire.user.shoping-cart',[
            'carts' => Cart::where('user_id', Auth::user()->id)->get(),
        ])->extends('user.layouts.user_one');
    }
}
