<div>
      @section('title', 'Categories')

      @section('css')
          <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
      @endsection
      
      <!-- Page Heading -->
      <h1 class="h3 mb-4 text-gray-800">Categories</h1>
    
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
      <div class="">
          <!-- Modal -->
          <div wire:ignore.self class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

        <div wire:ignore.self class="modal" tabindex="-1" role="dialog" id="editCategoryModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form>
                @csrf
                <input type="hidden" wire:model="category_id">
                <div class="modal-body">
                  <div class="form-group">
                    <input type="text" wire:model="name" class="form-control" value="" placeholder="Category Name" required>
                  </div>
                </div>

                <div class="modal-footer">
                  <button wire:click.prevent="update()" class="btn btn-success" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                  <a wire:click.prevent="cancel()" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Close</a>
                </div>
              </div>
              </form>
          </div>
        </div>

      <div class="row">
        <div class="col-md-8">

          <div class="card">
            <div class="card-header">
              <h3>Categories</h3>
            </div>
            <div class="card-body">
              <ul class="list-group">
                @foreach ($categories as $category)
                  <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                      {{ $category->name }}
                      {{-- <img src="{{ $category->getFirstMediaUrl('categories') }}" alt="" class="img-fluid"> --}}
                      <div class="btn-group" role="group" aria-label="Second group">
                        <a  wire:click="edit({{ $category->id }})" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editCategoryModal" data-backdrop="static" data-keyboard="false"><i class="fa fa-edit"></i></a>
                        <a wire:click="deleteId({{ $category->id }})" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal" data-backdrop="static" data-keyboard="false"><i class="fa fa-trash"></i></a>
                      </div>
                    </div>

                    <ul class="list-group mt-2">
                      @foreach ($category->children as $childCategory)
                        @include('admin.view_sub_category', ['child_category' => $childCategory])
                      @endforeach
                    </ul>

                  </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              <h3>Create Category</h3>
            </div>

            <div class="card-body">
              <form wire:submit.prevent="store">
                @csrf

                <div class="form-group">
                  <select class="form-control" wire:model="category_id">
                    <option value="">Select Parent Category</option>

                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @foreach ($category->children as $childCategory)
                          @include('admin.child_category', ['child_category' => $childCategory])
                      @endforeach
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <input type="text" wire:model="name" class="form-control" value="" placeholder="Category Name" required>
                </div>
                <div class="form-group">
                    <label class="control-label" for="description">Description</label>
                    <textarea class="form-control" rows="4" wire:model="description" id="description">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" id="featured"  wire:model="featured"/>Featured Category
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" id="menu"  wire:model="menu"/>Show in Menu
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Category Image</label>
                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"  wire:model="image"/>
                    @error('image') {{ $message }} @enderror
                    <div wire:loading wire:target="image">Uploading...</div>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Create</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <style scoped> .pagination { justify-content: center!important; } </style>
    <div class="mt-2">
      {{ $categories->links() }}
    </div>
    @section('js')
      <script src="{{ asset('toastr/toastr.min.js') }}"></script>
    @endsection
</div>
