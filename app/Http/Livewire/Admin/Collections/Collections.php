<?php

namespace App\Http\Livewire\Admin\Collections;

use Livewire\Component;
use App\Models\Collection;

class Collections extends Component
{
    public $updateMode = false;
    public $name;
    public $status;
    public $try_delete;
    public $selected_id;
    public $updated;

    public function cancel()
    {
        $this->updateMode = false;
        $this->reset();
    }

    public function store()
    {
        $validate = $this->validate([
            'name'      =>  'required|max:191',
        ]);
        $collecion = Collection::create($validate);

        if (!$collecion) {
            session()->flash('error', "Somethign went wrong!");
        }
        session()->flash('success', "You have successfully added a collection!");
        $this->reset();
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $record = Collection::findOrFail($id);
        $this->selected_id = $record->id;
        $this->name = $record->name;
        $this->status = $record->status;
    }
    
    public function update()
    {
        $this->validate([
            'name'      =>  'required|max:191',
        ]);

        $status = $this->status ? 1 : 0;

        $collection = Collection::find($this->selected_id);
        $updated = $collection->update([
            'name' => $this->name,
            'status' => $status,
        ]);

        if (!$updated) {
            session()->flash('worning', "Somethign went wrong!");
        }
         
        session()->flash('success', "You have successfully updated a collection!");
        $this->updateMode = false;
        $this->reset();
    }

    public function deleteId($id)
    {
        $this->try_delete = $id;
    }

    public function delete()
    {
        $collection = Collection::findOrFail($this->try_delete);
        $collection->delete();
        session()->flash('warning', 'Collection has been deleted!');
    }

    public function render()
    {
        $collections = Collection::all();
        return view('livewire.admin.collections.collections',[
            'collections' => $collections,
        ])->extends('admin.layout.base');
    }
}
