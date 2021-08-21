<div class="col-md-4">
    <figure class="card card-product-grid">
        <div class="row">
            <div class="col-md-12 col-5 p-r-0 center-responsive">
                <div class="img-wrap img-fluid center"> 
                    @php $date = \Carbon\Carbon::today()->subDays(15); @endphp
                    @if($product->created_at >= $date)
                    <span class="badge badge-danger"> NEW </span>
                    @endif
                    {{ $product->getFirstMedia('products') }}
                </div> <!-- img-wrap.// -->
            </div>
            <div class="col-md-12 col-7 p-l-0">
                <figcaption class="info-wrap">
                    <h6 class="a-size-mini spacing-none line-clamp-4">
                        <a href="{{ route('product.show', $product->slug) }}" class="a-color on-hover">
                            <span class="a-size-base-plus a-text-normal">
                                {{ $product->name }}
                            </span>
                        </a>
                    </h6>
                    
                    
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
                    @if($product->special_price)
                    <div class="price mt-1">{{ config('settings.currency_symbol') }} {{ $product->special_price }}</div> <!-- price-wrap.// -->
                    <div class="price-old mt-1"><span class="line-through">{{ config('settings.currency_symbol') }} {{ $product->price }}</span></div> <!-- price-wrap.// -->
                    @else
                    <div class="price mt-1">{{ config('settings.currency_symbol') }} {{ $product->price }}</div> <!-- price-wrap.// -->
                    @endif
                    <button wire:click="$emit('addCartEvent', {{ $product->id }})" class="btn square_btn_4 btn-block"><i
                        class="fas fa-shopping-cart pr-2"></i>Add to cart </button>
                </figcaption>
            </div>
        </div>
    </figure>
</div> <!-- col.// -->