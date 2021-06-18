<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart as Item;

class Cart extends Component
{
    protected $listeners = ['UpdateCart' => 'render'];

    public function render()
    {
        if (Auth::user()) {
            $cart = Item::where('user_id', Auth::user()->id)->get();
            $count = $cart->count();
        }else{
            $count = 0;
        }
        return view('livewire.user.cart',[
            'cart_count' => $count,
        ]);
    }
}
