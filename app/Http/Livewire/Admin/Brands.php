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
    public $brandId;
    public $selected_id;
    public $updated;
    public $updateMode = false;
    
    public function cancel()
    {
        $this->updateMode = false;
        $this->reset();
    }

    public function store()
    {
        $validate = $this->validate([
            'name'      =>  'required|max:191',
            'logo'      =>  'required',
        ]);

        $Brand = Brand::create($validate);

        if ($this->logo) {
            $Brand->addMedia($this->logo->getRealPath())
                ->withResponsiveImages()
                ->toMediaCollection('brands', 'brands');
        }

        if (!$Brand) {
            session()->flash('error', "Somethign went wrong!");
        }
        session()->flash('success', "You have successfully added a brand!");
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
        ]);

        $brand = Brand::find($this->selected_id);       

        $updated = $brand->update($validate);

        if (!$updated) {
            session()->flash('worning', "Somethign went wrong!");
        }
         
        session()->flash('success', "You have successfully updated a brand!");
        $this->updateMode = false;
        $this->reset();
    }

    public function uploadImage()
    {
        $brand = Brand::findOrFail($this->brandId);
        $this->validate([
            'logo'      =>  'required',
        ]);

        if ($this->logo) {
            $brand->addMedia($this->logo->getRealPath())
                ->withResponsiveImages()
                ->toMediaCollection('brands', 'brands');
        }

        session()->flash('success', "You successfully added brand logo!");
    }

    public function brandId($id)
    {
        $this->brandId = $id;
    }

    public function delete()
    {
        $brands = Brand::findOrFail($this->brandId);
        $brands->delete();
        session()->flash('warning', 'Brand has been deleted!');
    }

    public function render()
    {
        $brands = Brand::orderBy('id', 'DESC')->get();
        return view('livewire.admin.brands', [
            'brands' => $brands,
        ])->extends('admin.layout.base');
    }
}
