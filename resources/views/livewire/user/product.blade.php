<div>
    @section('title', 'Product')

    @section('css')

    <link rel="stylesheet" href="{{ asset('user/css/starrate.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/product_view.css') }}">
    @endsection
    {{-- Be like water. --}}
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
                                        @if ($product->images->count() > 0)
                                            @foreach($product->images as $image)
                                                <li><img class="thumbnail" src="{{ asset('storage/'.$image->images) }}" alt=""></li>
                                            @endforeach
                                        @endif
                                        </ul>
                                       <img id="slideRight" class="arrow" src="{{ asset('user/images/arrow-right.png') }}">
                                    </div>
                                </div>
                                <div class="col-md-10 center">
                                    <div class="picZoomer">
                                    @if ($product->images->count() > 0)
                                    <img id="featured" id="zoom-img" style="width: 100%; max-width: 410px; height: auto;" src="{{ asset('storage/'.$product->images->first()->images) }}">
                                    @else
                                        <img id="featured" id="zoom-img" style="width: 100%; max-width: 410px; height: auto;" src="https://via.placeholder.com/176">
                                    @endif
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
                            <div class="row">
                                @if($attribute_price)
                                <div class="col-md-3 col-4 text-left mt-1">
                                    <h6><strong>{{ $attribute_price }}</strong></h6> <!-- price-wrap.// -->
                                    <input wire:model="price" type="hidden" value="{{ $attribute_price }}">
                                </div>
                                @elseif($variation_price)
                                <div class="col-md-3 col-4 text-left mt-1">
                                    <h6><strong>{{ $variation_price }}</strong></h6> <!-- price-wrap.// -->
                                    <input wire:model="price" type="hidden" value="{{ $variation_price }}">
                                </div>
                                @else
                                    @if ($product->special_price)
                                    <div class="col-md-3 col-4 text-left mt-1">
                                        <h6><strong>{{ $product->special_price }}</strong></h6> <!-- price-wrap.// -->
                                        <input wire:model="price" type="hidden" value="{{ $product->special_price }}">
                                    </div>
                                    <div class="col-md-4 col-6 text-left mt-1">
                                        <h6 class="text-muted"><span class="line-through">{{ $product->price }}</span></h6> <!-- price-wrap.// -->
                                    </div>
                                    @else
                                    <div class="col-md-3 col-4 text-left mt-1">
                                        <h6><strong>{{ $product->price }}</strong></h6> <!-- price-wrap.// -->
                                        <input wire:model="price" type="hidden" value="{{ $product->price }}">
                                    </div>
                                    @endif
                                @endif
                            </div>
                            <div class="row">
                                {{-- Product Attributes --}}
                                @foreach($attributes as $attribute)
                                    @php $attributeCheck = in_array($attribute->id, $product->attributes->pluck('attribute_id')->toArray()) @endphp
                                    @if ($attributeCheck)
                                        <div class="form-group ml-3">
                                            <label><dt>{{ $attribute->name }}: </dt></label>
                                            <div class="mt-2">
                                                @foreach($product->attributes as $index => $attributeValue)
                                                    @if ($attributeValue->attribute_id == $attribute->id)
                                                    <label class="custom-control custom-radio custom-control-inline">
                                                    <input wire:click="addToAttributes({{ $attributeValue->id }}, '{{ $attributeValue->price }}')" wire:model="checked_attributes[]" type="radio" name="{{ strtolower($attribute->name ) }}" class="custom-control-input"  @if (!$index) {!! "checked" !!} @endif required>
                                                    <div class="custom-control-label">{{ $attributeValue->value }}</div>
                                                    </label>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="row">
                                {{-- Product Variations --}}
                                <div class="form-group ml-3">
                                    @if($variation)
                                    <label><dt>{{ $variation->name }}: </dt></label>
                                    @endif
                                    <div class="mt-2">
                                    @if($related_variants)
                                        @foreach($related_variants as $index => $product_variation)
                                            <label class="custom-control custom-radio custom-control-inline">
                                            <input wire:click="addToVariations('{{ $product_variation->price }}')" wire:model="checked_variations[]" type="radio" name="{{ strtolower($variation->name) }}" value="{{$variation->name}}" class="custom-control-input"  @if (!$index) {!! "checked" !!} @endif required>
                                            <div class="custom-control-label">{{ $product_variation->value }}</div>
                                            </label>
                                        @endforeach
                                    @else
                                        @if($product_variations)
                                        @foreach($product_variations as $index => $product_variation)
                                            <label class="custom-control custom-radio custom-control-inline">
                                            <input wire:click="addToVariations('{{ $product_variation->price }}')" wire:model="checked_variations[]" type="radio" name="{{ strtolower($variation->name) }}" value="{{$variation->name}}" class="custom-control-input"  @if (!$index) {!! "checked" !!} @endif required>
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
                                        <input type="number" wire:model="quantity" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">
                                        <input type="button" value="+" class="plus">
                                    </div>
                                </div> <!-- col.// -->
                            </div> <!-- row.// -->

                            <a class="square_btn_2 mr-4">Buy now</button>
                                {{ $product->name }}
                                <a wire:click.prevent="addToCart({{$product->id}})" class="square_btn"><i
                                    class="fas fa-shopping-cart pr-2"></i>Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                
            </div>
        </div>
    </div>
    
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <img src="https://m.media-amazon.com/images/S/aplus-media/vc/1406ff2d-2bc3-4dfd-8b74-ac1c1f3cc401.__CR0,0,1464,600_PT0_SX1464_V1___.jpg" style="width: 100%;" alt="">
            </div>
            <div class="col-12">
                <div class="display-table p-5">
                    <div class="md-display-table-cell sm-display-table-row md-center-half">
                        <h2>Hello there header</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum tempore magnam deleniti? Necessitatibus eaque vel ut provident, explicabo voluptate corrupti delectus nisi quia doloribus accusamus quos. Voluptas aperiam iste dolore!</p>
                    </div>
                    <div class="md-display-table-cell sm-display-table-row md-center-half">
                        <img src="https://m.media-amazon.com/images/S/aplus-media/vc/987cf490-966d-44aa-a35f-2d55933de9c8.__CR0,0,800,600_PT0_SX800_V1___.jpg" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="display-table p-5">
                    <div class="md-display-table-cell sm-display-table-row md-center-half">
                        <img src="https://m.media-amazon.com/images/S/aplus-media/vc/d0a52cc9-1658-4388-8193-7c017253ef1f.__CR0,0,800,600_PT0_SX800_V1___.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="md-display-table-cell sm-display-table-row md-center-half">
                        <h2>Bring home a beauty</h2>
                        <p><strong>Vivid views:</strong> 27-inch FHD (1920 x 1080) Infinity Touch Display, this Full HD display looks incredible from nearly every angle.</p>
                         <p><strong>Modern set-up:</strong> Experience improved stability, fewer distractions and stunning design with space-efficient stand, a forward-firing sound bar and keyboard storage underneath your display.</p>
                    </div>
                </div>
            </div>
    
            <div class="col-12">
                <h2>This is a header</h2>
                <img src="https://m.media-amazon.com/images/S/aplus-media/vc/1406ff2d-2bc3-4dfd-8b74-ac1c1f3cc401.__CR0,0,1464,600_PT0_SX1464_V1___.jpg" style="width: 100%;" alt="">
            </div>
        </div>
    </div>
    
    
    <div class="container-fluid">
        <div class="row padding-y">
            <div class="col-12 text-center">
                <h4>Technical Details</h4>
                <h5>Apple iPad - 10.2-inch (8th Generation)</h5>
            </div>
            <div class="col-12 mt-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td style="width: 120px;">
                                            <p>
                                                <strong>
                                                    Display
                                                </strong>
                                            </p>
                                        </td>
                                        <td>10.2‑inch Retina display</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 120px;">
                                            <p>
                                                <strong>
                                                    Display
                                                </strong>
                                            </p>
                                        </td>
                                        <td>10.2‑inch Retina display</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 120px;">
                                            <p>
                                                <strong>
                                                    Display
                                                </strong>
                                            </p>
                                        </td>
                                        <td>10.2‑inch Retina display</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td style="width: 120px;">
                                            <p>
                                                <strong>
                                                    Camera and Video
                                                </strong>
                                            </p>
                                        </td>
                                        <td>8MP camera with HDR and 1080p HD video</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 120px;">
                                            <p>
                                                <strong>
                                                    Chip
                                                </strong>
                                            </p>
                                        </td>
                                        <td>A12 Bionic chip with 64-bit architecture Neural Engine</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 120px;">
                                            <p>
                                                <strong>
                                                    Display
                                                </strong>
                                            </p>
                                        </td>
                                        <td>10.2‑inch Retina display</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <hr>
    <div class="container-fluid">
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
                        <a class="square_btn_3">Give a review</a>
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
    </div>
    @section('js')

    <script src="{{ asset('user/js/product_img_slider.js') }}" type="text/javascript"></script>
    <script src="{{ asset('user/js/zoomsl.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#featured').imagezoomsl({
                zoomrange: [3, 3]
            });
        });
    </script>
    <script src="{{ asset('user/js/quantity.js') }}" type="text/javascript"></script>
    @endsection
</div>
