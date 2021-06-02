@extends('admin.layout.base')

@section('title', 'Add Product')

@section('css')
<link rel="stylesheet" href="{{ asset('admin/select/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin/dropzone/min/dropzone.min.css') }}"/>
@endsection

@section('content')
@if (Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif
@if (Session::has('errors'))
<div class="alert alert-danger" role="alert">
    {{ Session::get('error') }}
</div>
@endif

<div class="row">
    <div class="col-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link general active" id="v-pills-general-tab" data-toggle="pill" href="#v-pills-general" role="tab" aria-controls="v-pills-general" aria-selected="true">General</a>
                    <a class="nav-link image" id="v-pills-image-tab" data-toggle="pill" href="#v-pills-image" role="tab" aria-controls="v-pills-image" aria-selected="false">Images</a>
                    <a class="nav-link" id="v-pills-attribute-tab" data-toggle="pill" href="#v-pills-attribute" role="tab" aria-controls="v-pills-attribute" aria-selected="false">Attributes</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-9">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="tile">
                            <form action="{{ route('admin.product.update') }}" method="POST" role="form">
                                @csrf
                                <h3 class="tile-title">Product Information</h3>
                                <hr>
                                <div class="tile-body">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Name</label>
                                        <input
                                            class="form-control @error('name') is-invalid @enderror"
                                            type="text"
                                            placeholder="Enter attribute name"
                                            id="name"
                                            name="name"
                                            value="{{ old('name', $product->name) }}"
                                        />
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <div class="invalid-feedback active">
                                            <i class="fa fa-exclamation-circle fa-fw"></i> @error('name') <span>{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="sku">SKU</label>
                                                <input
                                                    class="form-control @error('sku') is-invalid @enderror"
                                                    type="text"
                                                    placeholder="Enter product sku"
                                                    id="sku"
                                                    name="sku"
                                                    value="{{ old('sku', $product->sku) }}"
                                                />
                                                <div class="invalid-feedback active">
                                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('sku') <span>{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="brand_id">Brand</label>
                                                <select name="brand_id" id="brand_id" class="form-control @error('brand_id') is-invalid @enderror">
                                                    <option value="0">Select a brand</option>
                                                    @foreach($brands as $brand)
                                                        @if ($product->brand_id == $brand->id)
                                                            <option value="{{ $brand->id }}" selected>{{ $brand->name }}</option>
                                                        @else
                                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback active">
                                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('brand_id') <span>{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label" for="categories">Categories</label>
                                                <select name="categories[]" id="categories" class="form-control" multiple>
                                                    @foreach($categories as $category)
                                                    @php $check = in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'selected' : ''@endphp
                                                        <option value="{{ $category->id }}" {{ $check }}>{{ $category->name }}</option>
                                                        @foreach ($category->children as $childCategory)
                                                            @include('admin.products.child_category_for_edit', ['child_category' => $childCategory])
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="price">Price</label>
                                                <input
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    type="text"
                                                    placeholder="Enter product price"
                                                    id="price"
                                                    name="price"
                                                    value="{{ old('price', $product->price) }}"
                                                />
                                                <div class="invalid-feedback active">
                                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('price') <span>{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="special_price">Special Price</label>
                                                <input
                                                    class="form-control"
                                                    type="text"
                                                    placeholder="Enter product special price"
                                                    id="special_price"
                                                    name="special_price"
                                                    value="{{ old('special_price', $product->special_price) }}"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="quantity">Quantity</label>
                                                <input
                                                    class="form-control @error('quantity') is-invalid @enderror"
                                                    type="number"
                                                    placeholder="Enter product quantity"
                                                    id="quantity"
                                                    name="quantity"
                                                    value="{{ old('quantity', $product->quantity) }}"
                                                />
                                                <div class="invalid-feedback active">
                                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('quantity') <span>{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="weight">Weight</label>
                                                <input
                                                    class="form-control"
                                                    type="text"
                                                    placeholder="Enter product weight"
                                                    id="weight"
                                                    name="weight"
                                                    value="{{ old('weight', $product->weight) }}"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="description">Description</label>
                                        <textarea name="description" id="description" rows="8" class="form-control">{{ old('description', $product->description) }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input"
                                                        type="checkbox"
                                                        id="status"
                                                        name="status"
                                                        {{ $product->status == 1 ? 'checked' : '' }}
                                                    />Status
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input"
                                                        type="checkbox"
                                                        id="featured"
                                                        name="featured"
                                                        {{ $product->featured == 1 ? 'checked' : '' }}
                                                    />Featured
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="tile-footer">
                                    <div class="row d-print-none mt-2">
                                        <div class="col-12 text-right">
                                            <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Product</button>
                                            <a class="btn btn-danger" href="{{ route('admin.products.list') }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Go Back</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-image" role="tabpanel" aria-labelledby="v-pills-image-tab">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="tile">
                            <h3 class="tile-title">Upload Image</h3>
                            <hr>
                            <div class="tile-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="" class="dropzone" id="dropzone" style="border: 2px dashed rgba(0,0,0,0.3)">
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                                <div class="row d-print-none mt-2">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-success" type="button" id="uploadButton">
                                            <i class="fa fa-fw fa-lg fa-upload"></i>Upload Images
                                        </button>
                                    </div>
                                </div>
                                @if ($product->images)
                                    <hr>
                                    <div class="row">
                                        @foreach($product->images as $image)
                                            <div class="col-md-3">
                                                <div class="card shadow-sm">
                                                    <div class="card-body">
                                                        <img src="{{ asset('storage/'.$image->images) }}" id="brandLogo" class="img-fluid" alt="img">
                                                        <a class="card-link float-right text-danger" href="{{ route('admin.product.images.delete', $image->id) }}">
                                                            <i class="fa fa-fw fa-lg fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-attribute" role="tabpanel" aria-labelledby="v-pills-attribute-tab">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="tile">
                            <form action="{{ route('admin.product.attribut.store') }}" method="POST">
                                @csrf
                                <div class="tile">
                                    <h3 class="tile-title">Product Attributes</h3>
                                    <hr>
                                    <div class="tile-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="parent">Select an Attribute <span class="m-l-5 text-danger"> *</span></label>
                                                    <select class="form-control custom-select mt-15" name="attribute_id">
                                                        {{-- <option :value="attribute" v-for="attribute in attributes"> {{ attribute.name }} </option> --}}
                                                        <option value="">Select a brand</option>
                                                        @foreach($attributes as $attribute)
                                                            <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="tile-title">Add Attributes To Product</h3>
                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="value">Value</label>
                                        <input class="form-control" type="text" id="value" name="value"/>
                                        </select>
                                    </div>
                
                
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="attribut_quantity">Quantity</label>
                                        <input class="form-control" type="number" id="attribut_quantity" name="attribut_quantity"/>
                                    </div>
                
                
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="attribut-price">Price</label>
                                        <input class="form-control" type="text" id="attribut-price"  name="attribut_price"/>
                                        <small class="text-danger">This price will be added to the main price of product on frontend.</small>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <button class="btn btn-sm btn-primary pull-bottom" type="submit">
                                            <i class="fa fa-plus"></i> Add
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mt-3">
                    <div class="card-body">
                        <div class="tile">
                            <h3 class="tile-title">Product Attributes</h3>
                            <div class="tile-body">
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                        <tr class="text-center">
                                            <th>Value</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($product_attributes as $product_attribute)
                                        <tr v-for="pa in productAttributes">
                                            <td style="width: 25%" class="text-center">{{ $product_attribute->value}}</td>
                                            <td style="width: 25%" class="text-center">{{ $product_attribute->quantity}}</td>
                                            <td style="width: 25%" class="text-center">{{ $product_attribute->price}}</td>
                                            <td style="width: 25%" class="text-center">
                                                <a class="btn btn-sm btn-danger" href="{{ route('admin.product.attribut.delete', $product_attribute->id) }}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
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
    </div>
  </div>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('admin/select/js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/dropzone/min/dropzone.min.js') }}"></script>
<script>
    Dropzone.autoDiscover = false;

    $( document ).ready(function() {
        $('#categories').select2();

        let myDropzone = new Dropzone("#dropzone", {
            paramName: "image",
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            maxFilesize: 4,
            parallelUploads: 12,
            uploadMultiple: false,
            url: "{{ route('admin.product.images.upload') }}",
            autoProcessQueue: false,
        });
        myDropzone.on("queuecomplete", function (file) {
            window.location.reload();
            $(".general").removeClass("active");
            $(".image").addClass("active");
            showNotification('Completed', 'All product images uploaded', 'success', 'fa-check');
        });
        $('#uploadButton').click(function(){
            if (myDropzone.files.length === 0) {
                showNotification('Error', 'Please select files to upload.', 'danger', 'fa-close');
            } else {
                myDropzone.processQueue();
            }
        });
    });
</script>
@endsection