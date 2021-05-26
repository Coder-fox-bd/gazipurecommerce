@php $check = in_array($child_category->id, $product->categories->pluck('id')->toArray()) ? 'selected' : ''@endphp
<option value="{{ $child_category->id }}" {{ $check }}>{{ $child_category->name }}</option>
@if ($child_category->children)
    @foreach ($child_category->children as $childCategory)
        @include('admin.products.child_category_for_edit', ['child_category' => $childCategory])
    @endforeach
@endif