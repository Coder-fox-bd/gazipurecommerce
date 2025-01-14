<div>
    @section('title', $product->name )

    @section('css')

    <link rel="stylesheet" href="{{ mix('user/css/starrate.css') }}">
    <link rel="stylesheet" href="{{ mix('user/css/product_view.css') }}">
    <link rel="stylesheet" href="{{ mix('user/css/ckeditor.css') }}">
    <link rel="stylesheet" href="{{ mix('toastr/toastr.min.css') }}">
    @endsection
    {{-- Be like water. --}}
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 col-12">
                <div class="container-fluid">
                    <div class="row p-3">
                        <div class="col-md-6 _boxzoom">
                            <div class="row align-middle align-middle">
                                <div class="col-md-2 col-12 text-center">
                                    <div class="zoom-thumb text-center">
                                        <img id="slideLeft" class="arrow" src="{{ asset('user/images/arrow-left.png') }}">
                                        <ul class="piclist" id="slider">
                                            @foreach($product->getMedia('products') as $image)
                                                <li>{{ $image }}</li>
                                            @endforeach
                                        </ul>
                                       <img id="slideRight" class="arrow" src="{{ asset('user/images/arrow-right.png') }}">
                                    </div>
                                </div>
                                <div class="col-md-10 center">
                                    <div class="picZoomer">
                                    {{ $product->getFirstMedia('products') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>	
                                {{ $product->name }}
                            </h5>
                            <h6 class="text-primary"><span>Brand: {{ $product->brand->name }}</span></h6>
                            <div class="rating-wrap">
                                <ul class="rating-stars">
                                    <li style="width:100%" class="stars-active"> 
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
                                    </li>
                                </ul>
                                <span class="label-rating text-muted"> 34 reviws</span>
                            </div>
                            <p class="pt-1">
                                {{ $product->description }}
                            </p>
                            <form wire:submit.prevent="onSubmit(Object.fromEntries(new FormData($event.target)))">
                                @csrf
                                <input type="hidden" value="{{$product->id}}" name="id">
                                <div class="row">
                                    @if($attribute_price)
                                    <div class="col-md-3 col-4 text-left mt-1">
                                        <h6><strong>{{ config('settings.currency_symbol') }} {{ $attribute_price }}</strong></h6> <!-- price-wrap.// -->
                                        <input name="price" type="hidden" value="{{ $attribute_price }}">
                                    </div>
                                    @elseif($variation_price)
                                    <div class="col-md-3 col-4 text-left mt-1">
                                        <h6><strong>{{ config('settings.currency_symbol') }} {{ $variation_price }}</strong></h6> <!-- price-wrap.// -->
                                        <input name="price" type="hidden" value="{{ $variation_price }}">
                                    </div>
                                    @else
                                        @if ($product->special_price)
                                        <div class="col-md-3 col-4 text-left mt-1">
                                            <h6><strong>{{ config('settings.currency_symbol') }} {{ $product->special_price }}</strong></h6> <!-- price-wrap.// -->
                                            <input name="price" type="hidden" value="{{ $product->special_price }}">
                                        </div>
                                        <div class="col-md-4 col-6 text-left mt-1">
                                            <h6 class="text-muted"><span class="line-through">{{ config('settings.currency_symbol') }} {{ $product->price }}</span></h6> <!-- price-wrap.// -->
                                        </div>
                                        @else
                                        <div class="col-md-3 col-4 text-left mt-1">
                                            <h6><strong>{{ config('settings.currency_symbol') }} {{ $product->price }}</strong></h6> <!-- price-wrap.// -->
                                            <input name="price" type="hidden" value="{{ $product->price }}">
                                        </div>
                                        @endif
                                    @endif
                                </div>
                                <div class="row">
                                    {{-- Product Attributes --}}
                                    @forelse($attributes as $attribute)
                                        @php $attributeCheck = in_array($attribute->id, $product->attributes->pluck('attribute_id')->toArray()) @endphp
                                        @if ($attributeCheck)
                                            <div class="form-group ml-3">
                                                <label><dt>{{ $attribute->name }}: </dt></label>
                                                <div class="mt-2">
                                                    @foreach($product->attributes as $index => $attributeValue)
                                                        @if ($attributeValue->attribute_id == $attribute->id)
                                                        <label class="custom-control custom-radio custom-control-inline" wire:key="attribute-field-{{ $attribute->id }}">
                                                        <input wire:click="addToAttributes({{ $attributeValue->id }}, '{{ $attributeValue->value }}', '{{ $attributeValue->price }}')" type="radio" name="attribute" value="{{ $attributeValue->value }}" class="custom-control-input" @if (!$index) {!! "checked" !!} @endif required>
                                                        <div class="custom-control-label">{{ $attributeValue->value }}</div>
                                                        </label>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @else
                                        <input type="hidden" name="attribute">
                                        @endif
                                    @empty
                                    <input type="hidden" name="attribute">
                                    @endforelse
                                </div>
                                <div class="row">
                                    {{-- Product Variations --}}
                                    <div class="form-group ml-3">
                                        @if($variation)
                                        <label><dt>{{ $variation->name }}: </dt></label>
                                        @else
                                        <input type="hidden" name="variation">
                                        @endif
                                        <div class="mt-2">
                                        @if($related_variants)
                                            @foreach($related_variants as $index => $product_variation)
                                                <label class="custom-control custom-radio custom-control-inline">
                                                <input wire:click="addToVariations('{{ $product_variation->value }}','{{ $product_variation->price }}')" type="radio" name="variation" value="{{ $product_variation->value }}" class="custom-control-input" @if (!$index) {!! "checked" !!} @endif required>
                                                <div class="custom-control-label">{{ $product_variation->value }}</div>
                                                </label>
                                            @endforeach
                                        @else
                                            @if($product_variations)
                                            @foreach($product_variations as $index => $product_variation)
                                                <label class="custom-control custom-radio custom-control-inline">
                                                <input wire:click="addToVariations('{{ $product_variation->value }}','{{ $product_variation->price }}')" type="radio" name="variation" value="{{ $product_variation->value }}" class="custom-control-input" @if (!$index) {!! "checked" !!} @endif required>
                                                <div class="custom-control-label">{{ $product_variation->value }}</div>
                                                </label>
                                            @endforeach
                                            @endif
                                        @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md flex-grow-0">
                                        <label>Quantity</label>
                                        <div class="quantity buttons_added">
                                            <input type="button" value="-" class="minus">
                                            <input type="number" name="quantity" step="1" min="1" max="" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">
                                            <input type="button" value="+" class="plus">
                                        </div>
                                    </div> <!-- col.// -->
                                </div> <!-- row.// -->
                                <button type="submit" wire:click="buyNow" class="btn square_btn_2 mr-4">Buy now</button>
                                <button type="submit" name="action" value="add_to_cart" class="btn square_btn"><i
                                        class="fas fa-shopping-cart pr-2"></i>Add to cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                
            </div>
        </div>
    </div>
    
    {{-- Product long description --}}
    <div class="container">
        <div class="ck-content">
        @foreach ($product->longDescription as $object)
            {!! $object->description !!}
        @endforeach
        </div>
    </div>
    <hr>
    <div class="container-fluid">
        <header class="section-heading">
            <h3 class="section-title">Related Products</h3>
        </header><!-- sect-heading -->
        <div class="row">
        @foreach ($product->categories as $category)
            @foreach($category->relatedProducts as $product)
            @include('livewire.user.partials.product-col-3')
            @endforeach
        @endforeach
        </div>
    </div>
    <hr>
    {{-- <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="rating-block">
                            <h4>Average user rating</h4>
                            <h2 class="bold padding-bottom-7">4.3 <small>/ 5</small></h2>
                            <div class="mb-5">
                                <div class="reviewdiv">
                                    <img class="img" src="images/stars_blank.png" alt="img">
                                    <div class="reviewcornerimage" style="width:71%;">
                                        <img class="img" src="images/stars_full.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="p-3">
                            <h4 class="">Rating breakdown</h4>
    
                            <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">5 <span class="fa fa-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="5"
                                            aria-valuemin="0" aria-valuemax="5" style="width: 28%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;">40</div>
                            </div>
                
                            <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">4 <span class="fa fa-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="4"
                                            aria-valuemin="0" aria-valuemax="5" style="width: 39%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;">55</div>
                            </div>
                
                            <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">3 <span class="fa fa-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="3"
                                            aria-valuemin="0" aria-valuemax="5" style="width: 21.42857142857143%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;">30</div>
                            </div>
                
                            <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">2 <span class="fa fa-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="2"
                                            aria-valuemin="0" aria-valuemax="5" style="width: 5.714285714285714%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;">8</div>
                            </div>
                
                            <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">1 <span class="fa fa-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="1"
                                            aria-valuemin="0" aria-valuemax="5" style="width: 8%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;">7</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 center mt-3">
                        <a class="btn square_btn_3">Give a review</a>
                    </div>
                </div>
    
            </div>
    
            <div class="col-md-8 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 ml-1">
                                <h3>Reviews with images</h3>
                            </div>
                            <div class="col-12">
                                <div class="gallery">
                                    <a target="_blank" href=".jpg">
                                    <img src="images/items/2.jpg" alt="Cinque Terre" width="600" height="400">
                                    </a>
                                </div>
                                
                                <div class="gallery">
                                    <a target="_blank" href="img_forest.jpg">
                                    <img src="images/items/1.jpg" alt="Forest" width="600" height="400">
                                    </a>
                                </div>
                                
                                <div class="gallery">
                                    <a target="_blank" href="img_lights.jpg">
                                    <img src="images/items/3.jpg" alt="Northern Lights" width="600" height="400">
                                    </a>
                                </div>
                                
                                <div class="gallery">
                                    <a target="_blank" href="img_mountains.jpg">
                                    <img src="images/items/4.jpg" alt="Mountains" width="600" height="400">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 p-0 ml-1">
                            <a href="#">See all customer images</a>
                        </div>
                        <div class="col-12 pt-3">
                            <div class="review relative mt-3">
                                <div class="row">
                                    <a href="#" class="profile">
                                        <div class="profile-avatar-wrapper">
                                            <div class="profile-avatar">
                                                <img src="images/profile_img.jpg" style="width: 34px;" alt="">
                                            </div>
                                        </div>
                                        <div class="profile-content">
                                            <span class="profile-name">John walker</span>
                                        </div>
                                    </a>
                                    <div class="col-12 pl-1">
                                        <div class="reviewdiv mr-2">
                                            <img class="img" src="images/stars_blank.png" alt="img">
                                            <div class="reviewcornerimage" style="width:90%;">
                                                <img class="img" src="images/stars_full.png" alt="">
                                            </div>
                                        </div>
                                        <p><strong>this is a xoxx product</strong></p>
                                    </div>
                                    <div class="col-12 pl-1">
                                        <span class="mt-1">256GB SSD</span> |
                                        <span class="mt-1">256GB SSD</span> |
                                        <span class="mt-1">256GB SSD</span> |
                                        <span class="mt-1">256GB SSD</span> |
                                    </div>
                                    <div class="col-12 pl-1">
                                        <p>March 1, 1997</p>
                                    </div>
                                    <div class="col-md-10 col-12 pl-1 pt-1 pb-1">
                                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus 
                                            fuga voluptatum vitae dignissimos accusantium cum, eos atque eum 
                                            tenetur, quia quaerat numquam maxime autem dolorum delectus, 
                                            consequuntur impedit. Autem, iste.</p>
                                    </div>
                                </div>
                            </div>
    
                            <div class="review relative mt-3">
                                <div class="row">
                                    <a href="#" class="profile">
                                        <div class="profile-avatar-wrapper">
                                            <div class="profile-avatar">
                                                <img src="images/profile_img.jpg" style="width: 34px;" alt="">
                                            </div>
                                        </div>
                                        <div class="profile-content">
                                            <span class="profile-name">John walker</span>
                                        </div>
                                    </a>
                                    <div class="col-12 pl-1">
                                        <div class="reviewdiv mr-2">
                                            <img class="img" src="images/stars_blank.png" alt="img">
                                            <div class="reviewcornerimage" style="width:90%;">
                                                <img class="img" src="images/stars_full.png" alt="">
                                            </div>
                                        </div>
                                        <p><strong>this is a xoxx product</strong></p>
                                    </div>
                                    <div class="col-12 pl-1">
                                        <span class="mt-1">256GB SSD</span> |
                                        <span class="mt-1">256GB SSD</span> |
                                        <span class="mt-1">256GB SSD</span> |
                                        <span class="mt-1">256GB SSD</span> |
                                    </div>
                                    <div class="col-12 pl-1">
                                        <p>March 1, 1997</p>
                                    </div>
                                    <div class="col-md-10 col-12 pl-1 pt-1 pb-1">
                                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus 
                                            fuga voluptatum vitae dignissimos accusantium cum, eos atque eum 
                                            tenetur, quia quaerat numquam maxime autem dolorum delectus, 
                                            consequuntur impedit. Autem, iste.</p>
                                    </div>
                                </div>
                            </div>
    
                            <div class="review relative mt-3">
                                <div class="row">
                                    <a href="#" class="profile">
                                        <div class="profile-avatar-wrapper">
                                            <div class="profile-avatar">
                                                <img src="images/profile_img.jpg" style="width: 34px;" alt="">
                                            </div>
                                        </div>
                                        <div class="profile-content">
                                            <span class="profile-name">John walker</span>
                                        </div>
                                    </a>
                                    <div class="col-12 pl-1">
                                        <div class="reviewdiv mr-2">
                                            <img class="img" src="images/stars_blank.png" alt="img">
                                            <div class="reviewcornerimage" style="width:90%;">
                                                <img class="img" src="images/stars_full.png" alt="">
                                            </div>
                                        </div>
                                        <p><strong>this is a xoxx product</strong></p>
                                    </div>
                                    <div class="col-12 pl-1">
                                        <span class="mt-1">256GB SSD</span> |
                                        <span class="mt-1">256GB SSD</span> |
                                        <span class="mt-1">256GB SSD</span> |
                                        <span class="mt-1">256GB SSD</span> |
                                    </div>
                                    <div class="col-12 pl-1">
                                        <p>March 1, 1997</p>
                                    </div>
                                    <div class="col-md-10 col-12 pl-1 pt-1 pb-1">
                                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus 
                                            fuga voluptatum vitae dignissimos accusantium cum, eos atque eum 
                                            tenetur, quia quaerat numquam maxime autem dolorum delectus, 
                                            consequuntur impedit. Autem, iste.</p>
                                    </div>
                                </div>
                            </div>
    
                        </div>
                    </div>
    
    
                </div>
            </div>
        </div>
    </div> --}}
    @section('js')
    <script>
        $('.picZoomer img').attr('id', 'featured');
        $('.piclist li img').addClass('thumbnail');
    </script>
    <script src="{{ asset('user/js/product_img_slider.js') }}" type="text/javascript"></script>
    {{-- <script src="{{ asset('user/js/zoomsl.js') }}" type="text/javascript"></script> --}}
    <!-- F’in sweet Webflow Hacks -->
    <script>
        // if viewportWidth width > 991
        if(window.innerWidth > 991){
        // load mobile script
        loadScriptFile('{{ asset('user/js/zoomsl.js') }}');
        }
        
        // loadScriptFile func
        function loadScriptFile(src){
        // create element <script>
        const $script = $('<script>');
        // add type attribute
        $script.attr('type', 'text/javascript');
        // add src attribute
        $script.attr('src', src);
        // append the <script> element to <head>
        $script.appendTo('head');
        }
    </script>
    <script>
        if(window.innerWidth > 991){
            $(document).ready(function () {
                $('#featured').imagezoomsl({
                    zoomrange: [3, 3]
                });
            });
        }
    </script>
    <script src="{{ mix('user/js/quantity.js') }}" type="text/javascript"></script>
    <script src="{{ mix('toastr/toastr.min.js') }}"></script>
    @endsection
</div>
