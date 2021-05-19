<div>
    <!-- Attributes table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary">Attribute Table</h6>
                </div>
                <div class="col-6">
                    <!-- Large modal -->
                    <a class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th> Code </th>
                            <th> Name </th>
                            <th class="text-center"> Frontend Type </th>
                            <th class="text-center"> Filterable </th>
                            <th class="text-center"> Required </th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th> Code </th>
                            <th> Name </th>
                            <th class="text-center"> Frontend Type </th>
                            <th class="text-center"> Filterable </th>
                            <th class="text-center"> Required </th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($datas as $attribute)
                            <tr>
                                <td>{{ $attribute->code }}</td>
                                <td>{{ $attribute->name }}</td>
                                <td>{{ $attribute->frontend_type }}</td>
                                <td class="text-center">
                                    @if ($attribute->is_filterable == 1)
                                        <span class="badge badge-success">Yes</span>
                                    @else
                                        <span class="badge badge-danger">No</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($attribute->is_required == 1)
                                        <span class="badge badge-success">Yes</span>
                                    @else
                                        <span class="badge badge-danger">No</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Second group">
                                        <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    @if (Session::has('success'))
       <script>
       toastr.success("{{ Session::get('success') }}");
       </script>
    @endif
    @if (Session::has('errors'))
        <script>
        toastr.success("{{ Session::get('success') }}");
        </script>
    @endif
    <div wire:ignore.self class="modal bd-example-modal-lg" id="IDModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg">
           <div class="modal-content">
               <div class="row justify-content-center p-4">
                   <div class="col-md-9">
                       <div class="tab-content">
                           <div class="tab-pane active" id="general">
                               <div class="tile">
                                   <form wire:submit.prevent="store" data-toggle="validator" data-disable="false" method="POST" role="form">
                                       @csrf
                                       <h3 class="tile-title">Attribute Information</h3>
                                       <hr>
                                       <div class="tile-body">
                                           <div class="form-group">
                                               <label class="control-label" for="code">Code</label>
                                               <input
                                                   class="form-control"
                                                   type="text"
                                                   placeholder="Enter attribute code"
                                                   id="code"
                                                   wire:model="code"
                                               />
                                               @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                                           </div>
                                           <div class="form-group">
                                               <label class="control-label" for="name">Name</label>
                                               <input
                                                   class="form-control"
                                                   type="text"
                                                   placeholder="Enter attribute name"
                                                   id="name"
                                                   wire:model="name"
                                               />
                                               @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                           </div>
                                           <div class="form-group">
                                               <label class="control-label" for="frontend_type">Frontend Type</label>
                                               <select wire:model="frontend_type" id="frontend_type" class="form-control" required>
                                                   <option value="select">Select Box</option>
                                                   <option value="radio">Radio Button</option>
                                                   <option value="text">Text Field</option>
                                                   <option value="text_area">Text Area</option>
                                               </select>
                                               @error('frontend_type') <span class="text-danger">{{ $message }}</span> @enderror
                                           </div>
                                           <div class="form-group">
                                               <div class="form-check">
                                                   <label class="form-check-label">
                                                       <input class="form-check-input" type="checkbox" id="is_filterable" wire:model="is_filterable"/>Filterable
                                                   </label>
                                               </div>
                                           </div>
                                           <div class="form-group">
                                               <div class="form-check">
                                                   <label class="form-check-label">
                                                       <input class="form-check-input" type="checkbox" id="is_required" wire:model="is_required"/>Required
                                                   </label>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="tile-footer">
                                           <div class="row d-print-none mt-2">
                                               <div class="col-12 text-right">
                                                   <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Attribute</button>
                                                   <a wire:click.prevent="cancel()" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Cancel</a>
                                               </div>
                                           </div>
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
</div>
