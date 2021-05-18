@extends('admin.layout.base')

@section('title', 'Add Product')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Add Product</h1>

@livewire('admin.add-product')

@endsection

@section('livewire-script')
    @livewireScripts
@endsection