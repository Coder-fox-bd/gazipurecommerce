<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Attribute;

class AttributeList extends Component
{
    public $code;
    public $name;
    public $frontend_type;
    public $is_filterable;
    public $is_required;
    public $attribute;
    public $updateMode = false;

    protected $rules = [
        'code'          =>  'required|unique:attributes,code',
        'name'          =>  'required',
        'frontend_type' =>  'required',
         
    ];

    public function cancel()
    {
        $this->updateMode = false;
        $this->reset();
    }

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
        $this->reset();
    }

        // public function edit($attribute)
    // {
    //     $record = Attribute::findOrFail($attribute);
    //     $this->selected_id = $record->id;
    //     $this->code = $record->code;
    //     $this->name = $record->name;
    //     $this->frontend_type = $record->frontend_type;
    //     $this->is_filterable = $record->is_filterable;
    //     $this->is_required = $record->is_required; 
    // }
    
    public function render()
    {
        $datas = Attribute::orderBy('id', 'DESC')->get();
        return view('livewire.admin.attribute-list', [
            'datas' => $datas,
        ]);
    }
}
