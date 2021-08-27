<?php

namespace App\Http\Livewire\Admin\Orders;

use Livewire\Component;
use App\Models\Order;

class ShowOrder extends Component
{
    public $order_num;

    public function mount($order)
    {
        $this->order_num = $order;
    }

    public function render()
    {
        $order = Order::with('items')->where('order_number', $this->order_num)->first();
        return view('livewire.admin.orders.show-order',[
            "order" => $order,
        ])->extends('admin.layout.base');
    }
}
