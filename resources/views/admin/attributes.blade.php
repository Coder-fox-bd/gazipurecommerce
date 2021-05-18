@extends('admin.layout.base')

@section('title', 'Attributes')

@section('css')
<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Attributes</h1>
<a href="#" class="btn btn-primary pull-right">Add Attribute</a>

@livewire('admin.attribute-list')

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
@endsection