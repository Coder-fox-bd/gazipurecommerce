<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Brand;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Brands extends Component
{
    use WithFileUploads;
    public $name;
    public $logo;
    public $try_delete;
    public $selected_id;
    public $updated;
    public $updateMode = false;

    public function removeMe()
    {
      $this->logo = '';
    }
    
    public function cancel()
    {
        $this->updateMode = false;
        $this->reset();
    }

    public function store()
    {
        $validate = $this->validate([
            'name'      =>  'required|max:191',
            'logo'     =>  'nullable|mimes:jpg,jpeg,png|max:1000'
        ]);
        $validate['logo'] = $this->logo->store('brands', 'public');
        $Brand = Brand::create($validate);

        if (!$Brand) {
            session()->flash('error', "Somethign went wrong!");
        }
        session()->flash('success', "You have successfully added a Attribute!");
        $this->reset();
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $record = Brand::findOrFail($id);
        $this->selected_id = $record->id;
        $this->name = $record->name;
        $this->logo = $record->logo;
    }
    
    public function update()
    {
        $validate = $this->validate([
            'name'      =>  'required|max:191',
            'logo'     =>  'nullable|mimes:jpg,jpeg,png|max:1000'
        ]);

        $validate['logo'] = $this->logo->store('brands', 'public');
        $brand = Brand::find($this->selected_id);
        Storage::delete('public/'.$brand->logo);       

        $updated = $brand->update($validate);

        if (!$updated) {
            session()->flash('worning', "Somethign went wrong!");
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
        $brands = Brand::findOrFail($this->try_delete);
        if(Storage::delete('public/'.$brands->logo)) {
            $brands->delete();
            session()->flash('warning', 'Brand has been deleted!');
         }
    }

    public function render()
    {
        $brands = Brand::orderBy('id', 'DESC')->get();
        return view('livewire.admin.brands', [
            'brands' => $brands,
        ])->extends('admin.layout.base');
    }
}
