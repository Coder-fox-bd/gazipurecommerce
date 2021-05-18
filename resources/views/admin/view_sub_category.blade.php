<li class="list-group-item mt-2">
    <div class="d-flex justify-content-between">
        {{ $child_category->name }}
        <div class="button-group d-flex">
        <button wire:click="edit({{ $child_category->id }})" class="btn btn-sm btn-primary mr-1 edit-category" data-toggle="modal" data-target="#editCategoryModal" data-id="{{ $category->id }}" data-name="{{ $category->name }}">Edit</button>
        <button wire:click="deleteId({{ $child_category->id }})" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal">Delete</button>
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