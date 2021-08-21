<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\WishList;

class ShopingCart extends Component
{
    public $Carts;
    public function delete($id)
    {
        $item = Cart::findOrFail($id);
        if ($item) {
            $item->delete();
            $this->emit('UpdateCart');
        }
    }

    public function saveForLatter($id)
    {
        $item = Cart::findOrFail($id);
        if ($item) {
            $to_arr = $item->toArray();
            unset($to_arr['id'], $to_arr['created_at'], $to_arr['updated_at']);
            WishList::insert($to_arr);
            $item->delete();
            $this->emit('UpdateCart');
        }
    }

    public function render()
    {
        if(Auth::user()){
            $this->Carts = Auth::user()->cart;
        }
        return view('livewire.user.shoping-cart',[
            'carts' => $this->Carts,
        ])->extends('user.layouts.user_one');
    }
}
