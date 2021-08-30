<?php

namespace App\Http\Livewire\Admin\Orders;

use Livewire\Component;
use App\Models\Order;
use PDF;

class ShowOrder extends Component
{
    public $order;

    public function mount($order_num)
    {
        $this->order = Order::with('items')->where('order_number', $order_num)->first();
    }

    public function exportPDF()
    {
        $pdfContent = PDF::loadView('livewire.admin.orders.order-pdf', ['order' => $this->order])->output();
        return response()->streamDownload(
            fn () => print($pdfContent),
            "order.pdf"
        );
    }

    public function placeOrder()
    {
        $this->order->update(['status' => 'Placed']);
    }

    public function outForDelivery()
    {
        $this->order->update(['status' => 'In delivery']);
    }

    public function completed()
    {
        $this->order->update(['status' => 'Completed']);
    }

    public function render()
    {
        return view('livewire.admin.orders.show-order')->extends('admin.layout.base');
    }
}
