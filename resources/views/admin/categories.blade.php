@extends('admin.layout.base')

@section('title', 'Categories')

@section('css')
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
@endsection

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Categories</h1>

@livewire('admin.categories')


@endsection

@section('livewire-script')
    @livewireScripts
@endsection

@section('js')
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>
@endsection