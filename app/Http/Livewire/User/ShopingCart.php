<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class ShopingCart extends Component
{
    public $Carts;
    public function delete($id)
    {
        $item = Cart::findOrFail($id);
        if ($item) {
            $item->delete();
            $this->emit(event: 'UpdateCart');
        }
    }
    public function render()
    {
        if(Auth::user()){
            $this->Carts = Cart::where('user_id', Auth::user()->id)->get();
        }
        return view('livewire.user.shoping-cart',[
            'carts' => $this->Carts,
        ])->extends('user.layouts.user_one');
    }
}
