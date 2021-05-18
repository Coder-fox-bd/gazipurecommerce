<option value="{{ $child_category->id }}">{{ $child_category->name }}</option>
@if ($child_category->children)
    @foreach ($child_category->children as $childCategory)
        @include('admin.child_category', ['child_category' => $childCategory])
    @endforeach
@endif