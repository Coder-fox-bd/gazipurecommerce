@extends('admin.layout.base')

@section('title', 'Products')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-4 text-gray-800">Products</h1>
    <a href="{{ route('admin.product.create') }}" 
    class="d-inline-block btn btn-sm btn-primary shadow-sm">Add Product</a>
</div>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th> # </th>
                                    <th> SKU </th>
                                    <th> Name </th>
                                    <th class="text-center"> Brand </th>
                                    <th class="text-center"> Categories </th>
                                    <th class="text-center"> Price </th>
                                    <th class="text-center"> Status </th>
                                    <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                                </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th> # </th>
                                        <th> SKU </th>
                                        <th> Name </th>
                                        <th class="text-center"> Brand </th>
                                        <th class="text-center"> Categories </th>
                                        <th class="text-center"> Price </th>
                                        <th class="text-center"> Status </th>
                                        <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->sku }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->brand->name }}</td>
                                            <td>
                                                @foreach($product->categories as $category)
                                                    <span class="badge badge-info">{{ $category->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ config('settings.currency_symbol') }}{{ $product->price }}</td>
                                            <td class="text-center">
                                                @if ($product->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Not Active</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Second group">
                                                    <a class="btn btn-sm btn-success" id="{{ config('app.url') }}/product/{{ $product->slug }}" onClick="copy_url(this.id)" data-toggle="tooltip" data-placement="right" title="Copy Url">
                                                        <i class="far fa-copy"></i>
                                                    </a>
                                                    <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                                    <a href="{{ route('admin.product.delete', $product->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <!-- Page level plugins -->
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                "scrollX": true
            } );
        } );
    </script>
        
    <script type="text/javascript">
      function copy_url(url)
      {
        navigator.clipboard.writeText(url)
        var tooltip = document.getElementById(url);
        tooltip.title = "Url Copied";
        tooltip.classList.remove('btn-success');
        tooltip.classList.add('btn-secondary');
      }
    </script>
@endsection