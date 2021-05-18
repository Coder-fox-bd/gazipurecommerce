@extends('admin.layout.base')

@section('title', 'Add Attributes')

@section('css')
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
@endsection

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Add Attribute</h1>

@livewire('admin.create-attributes')

@endsection

@section('livewire-script')
    @livewireScripts
@endsection

@section('js')
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>
@endsection