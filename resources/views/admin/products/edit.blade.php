@extends('admin.layout.base')

@section('title', 'Edit Product')

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
    <div class="col-md-12 mb-2">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link general active" id="v-pills-general-tab" data-toggle="pill" href="#v-pills-general" role="tab" aria-controls="v-pills-general" aria-selected="true">General</a>
                    <a class="nav-link description" id="v-pills-description-tab" data-toggle="pill" href="#v-pills-description" role="tab" aria-controls="v-pills-description" aria-selected="true">Description</a>
                    <a class="nav-link image" id="v-pills-image-tab" data-toggle="pill" href="#v-pills-image" role="tab" aria-controls="v-pills-image" aria-selected="false">Images</a>
                    <a class="nav-link" id="v-pills-attribute-tab" data-toggle="pill" href="#v-pills-attribute" role="tab" aria-controls="v-pills-attribute" aria-selected="false">Attributes</a>
                    <a class="nav-link" id="v-pills-variations-tab" data-toggle="pill" href="#v-pills-variations" role="tab" aria-controls="v-pills-variations" aria-selected="false">Variations</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label" for="cost">Cost</label>
                                                <input
                                                    class="form-control @error('cost') is-invalid @enderror"
                                                    type="text"
                                                    placeholder="Enter product cost"
                                                    id="cost"
                                                    name="cost"
                                                    value="{{ old('cost', $product->cost) }}"
                                                />
                                                <div class="invalid-feedback active">
                                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('cost') <span>{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
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
                                        <div class="col-md-4">
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
                                        <label class="control-label" for="description">Short Details</label>
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
            {{-- Description --}}
            <div class="tab-pane fade" id="v-pills-description" role="tabpanel" aria-labelledby="v-pills-description-tab">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('admin.product.store-description') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <textarea class="form-control" name="description_textarea" id="description-textarea">
                                @if($product_description)
                                {{ $product_description->description }}
                                @endif
                            </textarea>
                            <button class="btn btn-primary mt-2">save</button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Image section --}}
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
                                <hr>
                                <div class="row">
                                    @foreach($product->getMedia('products') as $image)
                                        <div class="col-md-3">
                                            <div class="card shadow-sm">
                                                <div class="card-body product-img">
                                                    <img src="{{ $image->getUrl() }}" id="brandLogo" class="img-fluid" alt="img">
                                                    <a class="card-link float-right text-danger" href="{{ route('admin.product.images.delete', [$product->id, $image->id]) }}">
                                                        <i class="fa fa-fw fa-lg fa-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Attribute Section --}}
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
                                                        <option value="">Select an attribute</option>
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
                                        <input class="form-control" type="number" id="attribut_quantity" name="quantity"/>
                                    </div>
                
                
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="attribut-price">Price</label>
                                        <input class="form-control" type="text" id="attribut-price"  name="price"/>
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
            {{-- Variation Section --}}
            <div class="tab-pane fade" id="v-pills-variations" role="tabpanel" aria-labelledby="v-pills-variations-tab">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="tile">
                            <form action="{{ route('admin.product.variation.store') }}" method="POST">
                                @csrf
                                <div class="tile">
                                    <h3 class="tile-title">Product Attributes Variations</h3>
                                    <hr>
                                    <div class="tile-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="parent">Select Product Attribute <span class="m-l-5 text-danger"> *</span></label>
                                                    <select class="form-control custom-select mt-15" name="product_attribute_id">
                                                        <option value="">Select product attribute</option>
                                                        @foreach($product_attributes as $product_attribute)
                                                            <option value="{{ $product_attribute->id }}">{{ $product_attribute->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="parent">Select Variation <span class="m-l-5 text-danger"> *</span></label>
                                                    <select class="form-control custom-select mt-15" name="variation_id">
                                                        <option value="">Select a variation</option>
                                                        @foreach($variations as $variation)
                                                            <option value="{{ $variation->id }}">{{ $variation->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="tile-title">Add Variations To Product Attributes</h3>
                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="value">Value</label>
                                        <input class="form-control" type="text" id="value" name="value"/>
                                        </select>
                                    </div>
                
                
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="attribut_quantity">Quantity</label>
                                        <input class="form-control" type="number" id="attribut_quantity" name="quantity"/>
                                    </div>
                
                
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="attribut-price">Price</label>
                                        <input class="form-control" type="text" id="attribut-price"  name="price"/>
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
                            <h3 class="tile-title">Product Attributes Variations</h3>
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
                                        @foreach($product_variations as $product_variation)
                                        <tr v-for="pa in productAttributes">
                                            <td style="width: 25%" class="text-center">{{ $product_variation->value}}</td>
                                            <td style="width: 25%" class="text-center">{{ $product_variation->quantity}}</td>
                                            <td style="width: 25%" class="text-center">{{ $product_variation->price}}</td>
                                            <td style="width: 25%" class="text-center">
                                                <a class="btn btn-sm btn-danger" href="{{ route('admin.product.variation.delete', $product_variation->id) }}">
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
<script type="text/javascript" src="{{ asset('admin/ckeditor/build/ckeditor.js') }}"></script>
<script>
    class MyUploadAdapter {
        constructor( loader ) {
            // The file loader instance to use during the upload.
            this.loader = loader;
        }

        // Starts the upload process.
        upload() {
            return this.loader.file
                .then( file => new Promise( ( resolve, reject ) => {
                    this._initRequest();
                    this._initListeners( resolve, reject, file );
                    this._sendRequest( file );
                } ) );
        }

        // Aborts the upload process.
        abort() {
            if ( this.xhr ) {
                this.xhr.abort();
            }
        }

        // Initializes the XMLHttpRequest object using the URL passed to the constructor.
        _initRequest() {
            const xhr = this.xhr = new XMLHttpRequest();

            // Note that your request may look different. It is up to you and your editor
            // integration to choose the right communication channel. This example uses
            // a POST request with JSON as a data structure but your configuration
            // could be different.
            xhr.open( 'POST', '{{ route("admin.product.description-img-upload") }}', true );
            xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}')
            xhr.responseType = 'json';
        }

        // Initializes XMLHttpRequest listeners.
        _initListeners( resolve, reject, file ) {
            const xhr = this.xhr;
            const loader = this.loader;
            const genericErrorText = `Couldn't upload file: ${ file.name }.`;

            xhr.addEventListener( 'error', () => reject( genericErrorText ) );
            xhr.addEventListener( 'abort', () => reject() );
            xhr.addEventListener( 'load', () => {
                const response = xhr.response;

                // This example assumes the XHR server's "response" object will come with
                // an "error" which has its own "message" that can be passed to reject()
                // in the upload promise.
                //
                // Your integration may handle upload errors in a different way so make sure
                // it is done properly. The reject() function must be called when the upload fails.
                if ( !response || response.error ) {
                    return reject( response && response.error ? response.error.message : genericErrorText );
                }

                // If the upload is successful, resolve the upload promise with an object containing
                // at least the "default" URL, pointing to the image on the server.
                // This URL will be used to display the image in the content. Learn more in the
                // UploadAdapter#upload documentation.
                resolve( {
                    default: response.url
                } );
            } );

            // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
            // properties which are used e.g. to display the upload progress bar in the editor
            // user interface.
            if ( xhr.upload ) {
                xhr.upload.addEventListener( 'progress', evt => {
                    if ( evt.lengthComputable ) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                } );
            }
        }

        // Prepares the data and sends the request.
        _sendRequest( file ) {
            // Prepare the form data.
            const data = new FormData();

            data.append( 'upload', file );

            // Important note: This is the right place to implement security mechanisms
            // like authentication and CSRF protection. For instance, you can use
            // XMLHttpRequest.setRequestHeader() to set the request headers containing
            // the CSRF token generated earlier by your application.

            // Send the request.
            this.xhr.send( data );
        }
    }

    function simpleUploadAdapterPlugin( editor ) {
        editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
            // Configure the URL to the upload script in your back-end here!
            return new MyUploadAdapter( loader );
        };
    }

    ClassicEditor
        .create( document.querySelector( '#description-textarea' ), {
            extraPlugins: [ simpleUploadAdapterPlugin ],
        } )
        .catch( error => {
            console.error( error );
        } );
    ClassicEditor.builtinPlugins.map( plugin => plugin.pluginName );
</script>
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