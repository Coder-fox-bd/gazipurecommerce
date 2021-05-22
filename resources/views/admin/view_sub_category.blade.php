<li class="list-group-item mt-2">
    <div class="d-flex justify-content-between">
        {{ $child_category->name }}
        <div class="btn-group" role="group" aria-label="Second group">
            <a  wire:click="edit({{ $child_category->id }})" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editCategoryModal"><i class="fa fa-edit"></i></a>
            <a wire:click="deleteId({{ $child_category->id }})" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-trash"></i></a>
        </div>
    </div>
</li>
@if ($child_category->children)
    @foreach ($child_category->children as $childCategory)
        <ul>
            @include('admin.view_sub_category', ['child_category' => $childCategory])
        </ul>
    @endforeach
@endif