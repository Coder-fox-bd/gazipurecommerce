<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Orders extends Component
{
    public $orders;

    public function render()
    {
        if(Auth::user()){
            $this->orders = Auth::user()->orders;
        }
        return view('livewire.user.orders',[
            'orders' => $this->orders->sortByAsc('id'),
        ])->extends('user.layouts.user_one');
    }
}
