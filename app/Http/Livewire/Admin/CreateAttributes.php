<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Attribute;
use Illuminate\Database\QueryException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class CreateAttributes extends Component
{
    public $code;
    public $name;
    public $frontend_type;
    public $collection;
    public $is_filterable;
    public $is_required;
    public $merge;
    public $attribute;
    public $except;

    protected $rules = [
        'code'          =>  'required',
        'name'          =>  'required',
        'frontend_type' =>  'required'
    ];

    public function store()
    {
        $this->validate();

        if ($this->is_filterable==null) {
            $is_filterable_val = 0;
        }else{
            $is_filterable_val = 1;
        }

        if ($this->is_required==null) {
            $is_required_val = 0;
        }else{
            $is_required_val = 1;
        }

        $attribute = Attribute::create([
            'code' => $this->code,
            'name' => $this->name,
            'frontend_type' => $this->frontend_type,
            'is_filterable' => $is_filterable_val,
            'is_required' => $is_required_val,
        ]);;

        if (!$attribute) {
            session()->flash('error', "Somethign went wrong!");
        }
        session()->flash('success', "You have successfully added a Attribute!");
    }

    public function render()
    {
        return view('livewire.admin.create-attributes');
    }
}
