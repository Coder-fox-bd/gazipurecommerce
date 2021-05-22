@extends('admin.layout.base')

@section('title', 'Attributes')



@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Attributes</h1>

@livewire('admin.attribute-list')

@endsection

@section('livewire-script')
    @livewireScripts
@endsection