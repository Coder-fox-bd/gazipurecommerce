<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Product;

class Search extends Component
{
    public $search = '';

    public function render()
    {
        $results = [];

        if (strlen($this->search) >= 1) {
            $results = Product::where('name', 'LIKE', '%' . $this->search . '%')->limit(5)->get();
        }


        return view('livewire.user.search',[
            'results' => $results,
        ]);
    }
}
