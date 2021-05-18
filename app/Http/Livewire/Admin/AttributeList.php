<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Attribute;

class AttributeList extends Component
{
    public function render()
    {
        $datas = Attribute::get();
        return view('livewire.admin.attribute-list', [
            'datas' => $datas,
        ]);
    }
}
