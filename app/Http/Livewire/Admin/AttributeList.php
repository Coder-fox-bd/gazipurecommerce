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
    public $selected_id;
    public $attribute;
    public $try_delete;
    public $updateMode = false;

    protected function rules()
    {
        return [
            'code' => 'required|unique:attributes,code,' . $this->selected_id,
            'name'          =>  'required',
            'frontend_type' =>  'required',
        ];
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->reset();
    }

    public function store()
    {
        $this->validate();

        $attribute = Attribute::create([
            'code' => $this->code,
            'name' => $this->name,
            'frontend_type' => $this->frontend_type,
            'is_filterable' => $this->is_filterable ? 1 : 0,
            'is_required' => $this->is_required ? 1 : 0,
        ]);

        if (!$attribute) {
            session()->flash('error', "Somethign went wrong!");
        }
        session()->flash('success', "You have successfully added a Attribute!");
        $this->reset();
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $record = Attribute::findOrFail($id);
        $this->selected_id = $record->id;
        $this->code = $record->code;
        $this->name = $record->name;
        $this->frontend_type = $record->frontend_type;
        $this->is_filterable = $record->is_filterable;
        $this->is_required = $record->is_required; 
    }
    
    public function update()
    {
        $this->validate();
        $attribute = Attribute::find($this->selected_id);
        
        $updated = $attribute->update([
            'code' => $this->code,
            'name' => $this->name,
            'frontend_type' => $this->frontend_type,
            'is_filterable' => $this->is_filterable ? 1 : 0,
            'is_required' => $this->is_required ? 1 : 0,
        ]);

        if (!$updated) {
            session()->flash('error', "Somethign went wrong!");
        }
        session()->flash('success', "You have successfully updated a Attribute!");
        $this->updateMode = false;
        $this->reset();
    }

    public function deleteId($id)
    {
        $this->try_delete = $id;
    }

    public function delete()
    {
        if($this->try_delete){
            Attribute::find($this->try_delete)->delete();
            session()->flash('warning', 'Category has been deleted!');
        }
    }

    public function render()
    {
        $datas = Attribute::orderBy('id', 'DESC')->get();
        return view('livewire.admin.attribute-list', [ 
            'datas' => $datas,
        ])->extends('admin.layout.base');
    }
}
