<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class Cart extends Component
{
    public $count = 0;
    protected $listeners = ['UpdateCart' => 'render'];

    public function render()
    {
        return view('livewire.user.cart',[
            'cart_count' => $this->count++,
        ]);
    }
}
