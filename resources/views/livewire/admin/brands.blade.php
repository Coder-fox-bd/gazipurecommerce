<div>
    @section('title', 'Brands')
    @section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
    @endsection
    <style>.toast-success { background-color: #51A351; }</style>
    <style>.toast-warning { background-color: #F89406; }</style>
    @if (Session::has('success'))
      <script>
        toastr.success("{{ Session::get('success') }}");
      </script>
    @endif
    @if (Session::has('warning'))
      <script>
        toastr.warning("{{ Session::get('warning') }}");
      </script>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary">Brand Table</h6>
                </div>
                <div class="col-6">
                    <!-- Large modal -->
                    <a class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target=".bd-example-modal-lg" data-backdrop="static" data-keyboard="false" ><i class="fas fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Name </th>
                                        <th> Slug </th>
                                        <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th> # </th>
                                        <th> Name </th>
                                        <th> Slug </th>
                                        <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                @foreach($brands as $brand)
                                    <tr>
                                        <td>{{ $brand->id }}</td>
                                        <td>{{ $brand->name }}</td>
                                        <td>{{ $brand->slug }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Second group">
                                                <a wire:click="edit({{ $brand->id }})" class="btn btn-sm btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" data-backdrop="static" data-keyboard="false"><i class="fa fa-edit"></i></a>
                                                <a wire:click="deleteId({{ $brand->id }})" class="btn btn-sm btn-danger" data-toggle="modal" data-target=".delete-modal" data-backdrop="static" data-keyboard="false"><i class="fa fa-trash"></i></a>
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
    <div wire:ignore.self class="modal bd-example-modal-lg" id="IDModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="row justify-content-center p-4">
                    <div class="col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="general">
                                <div class="tile">
                                    <form data-toggle="validator" data-disable="false" method="POST" role="form">
                                        @csrf
                                        <div class="tile-body">
                                            <div class="form-group">
                                                <label class="control-label" for="name">Name <span class="m-l-5 text-danger"> *</span></label>
                                                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" wire:model="name" />
                                                @error('name') {{ $message }} @enderror
                                            </div>
                                            <div class="form-group">
                                                @if ($logo)
                                                Photo Preview:
                                                <img class="img-fluid w-25 my-2 contenedor-img" src="{{ $logo->temporaryUrl() }}">
                                                <a wire:click="removeMe" >Remove</a>
                                                @endif 
                                                <label class="control-label">Brand Logo</label>
                                                <input class="form-control @error('logo') is-invalid @enderror" type="file" id="logo" wire:model="logo"/>
                                                @error('logo') {{ $message }} @enderror
                                            </div>
                                        </div>
                                        <div class="tile-footer">
                                            @if($this->updateMode)
                                            <button wire:click.prevent="update()" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Brand</button>
                                            @else
                                            <button wire:click.prevent="store()" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Brand</button>
                                            @endif
                                            &nbsp;&nbsp;&nbsp;
                                            <a wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
     <div wire:ignore.self class="modal delete-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm</h5>
                    <button wire:click.prevent="cancel()" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-footer">
                    <button wire:click.prevent="cancel()" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="delete()" class="btn btn-danger close-modal" data-dismiss="modal">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
     @section('js')
     <!-- Page level plugins -->
     <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
     <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
 
     <!-- Page level custom scripts -->
     <script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>

     <script src="{{ asset('toastr/toastr.min.js') }}"></script>
    @endsection
</div>
