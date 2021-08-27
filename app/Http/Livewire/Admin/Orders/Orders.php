<?php

namespace App\Http\Livewire\Admin\Orders;

use Livewire\Component;
use App\Models\Order;

class Orders extends Component
{
    public function render()
    {
        return view('livewire.admin.orders.orders',[
            "orders" => Order::orderBy('id','desc')->get(),
        ])->extends('admin.layout.base');
    }
}
