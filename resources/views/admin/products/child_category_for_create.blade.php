<option value="{{ $child_category->id }}">{{ $child_category->name }}</option>
@if ($child_category->children)
    @foreach ($child_category->children as $childCategory)
        @include('admin.products.child_category_for_create', ['child_category' => $childCategory])
    @endforeach
@endif