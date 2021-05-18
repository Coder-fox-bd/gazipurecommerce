<div>
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

                <form >
                  @csrf
                  <input type="hidden" wire:model="category_id">
                  <div class="modal-body">
                    <div class="form-group">
                      <input type="text" wire:model="name" class="form-control" value="" placeholder="Category Name" required>
                    </div>
                  </div>

                  <div class="modal-footer">
                    <button wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Update</button>
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
                        <div class="button-group d-flex">
                          <button wire:click="edit({{ $category->id }})" class="btn btn-sm btn-primary mr-1 edit-category" data-toggle="modal" data-target="#editCategoryModal">Edit</button>
                          <button wire:click="deleteId({{ $category->id }})" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal">Delete</button>
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
</div>
