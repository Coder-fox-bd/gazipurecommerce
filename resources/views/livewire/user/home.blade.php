<div>
    {{-- Do your work, then step back. --}}
    @section('title', 'Home')
    <!-- ========================= SECTION MAIN ========================= -->
    <section class="section-main">
        <div class="container-fluid">
        
            <div class="row">
                <div class="col-12 px-0">
                    <div class="container-fluid px-0">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner bg-info" role="listbox">
                                <div class="carousel-item active img-gradient">
                                    <a href="#">
                                        <img class="img-fluid" src="https://images-na.ssl-images-amazon.com/images/G/01/PrivateBrands/Amazon_Basics_GRD_DesktopHero_April_HomeRefresh_1500x600_1x_en._CB656581128_.jpg" alt="Image slide">
                                    </a>
                                </div>
                                <div class="carousel-item">
                                    <a href="#">
                                        <img class="img-fluid" src="https://images-na.ssl-images-amazon.com/images/G/01/AMAZON_FASHION/2021/journeys/MzBiNjIyYjgt/MzBiNjIyYjgt-N2I2YzNlY2It-w1500._CB655683470_.jpg" alt="Image slide">
                                    </a>
                                </div>
                                <div class="carousel-item">
                                    <a href="#">
                                        <img class="img-fluid" src="https://images-na.ssl-images-amazon.com/images/G/01/US-hq/2021/img/Events/MothersDay/Homepage/T3_2021_MothersDay_GW_HomepageHero_Desktop_Gifting_1x_1500x600._CB658614325_.jpg" alt="Image slide">
                                    </a>
                                </div>
                                <div class="carousel-item">
                                    <a href="#">
                                        <img class="img-fluid" src="https://images-na.ssl-images-amazon.com/images/G/01/kindle/journeys/Y2UwYWM0MDQt/Y2UwYWM0MDQt-YWRmMTExOWMt-w1500._CB670370124_.jpg" alt="Image slide">
                                    </a>
                                </div>
                                <div class="carousel-item">
                                    <img class="img-fluid" src="https://images-na.ssl-images-amazon.com/images/G/01/kindle/journeys/NjA0N2YxY2It/NjA0N2YxY2It-NDg0ZTBmMDEt-w1500._CB655440701_.jpg" alt="Image slide">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div> <!-- row.// -->
        </div> <!-- container-fluid //  -->
    </section>
    <!-- ========================= SECTION MAIN END// ========================= -->
    
    
    
    <!-- ========================= SECTION CONTENT ========================= -->
    <section class="section-content bg-transparent-white">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <header class="section-heading">
                        <h3 class="section-upper-title">Featured Categories</h3>
                    </header><!-- sect-heading -->
                </div>
            </div>
                
            <div class="row">
                @foreach($categories->where('featured', 1)->take(4) as $category)
                <div class="col-md-3 mt-1">
                    <div class="card-banner" style="height:250px; background-image: url('{{ asset('storage/'.$category->image) }}');">
                        <article class="overlay overlay-cover d-flex align-items-center justify-content-center">
                            <div class="text-center">
                                <h5 class="card-title">{{ $category->name }}</h5>
                                <a href="{{ route('category.show', $category->slug) }}" class="btn btn-warning btn-sm"> View All </a>
                            </div>
                        </article>
                    </div>
                    <!-- card.// -->
                </div>
                @endforeach
            </div>
        
        </div> <!-- container-fluid .//  -->
    </section>
    <!-- ========================= SECTION CONTENT END// ========================= -->
    
    
    
        <!-- ========================= SECTION CONTENT ========================= -->
    <section class="section-content">
        <div class="container-fluid">
        
        <header class="section-heading">
            <h3 class="section-title">New arrived</h3>
        </header><!-- sect-heading -->
        
        <div class="row">
            @foreach($products->sortByDesc('id')->take(8) as $product)
            <div class="col-md-3">
                <figure class="card card-product-grid">
                    <div class="row">
                        <div class="col-md-12 col-5 p-r-0 center-responsive">
                            <div class="img-wrap img-fluid center"> 
                                @php $date = \Carbon\Carbon::today()->subDays(30); @endphp
                                @if($product->created_at >= $date)
                                <span class="badge badge-danger"> NEW </span>
                                @endif
                                @if ($product->images->count() > 0)
                                <img src="{{ asset('storage/'.$product->images->first()->images) }}">
                                @else
                                <img src="https://via.placeholder.com/176" alt="">
                                @endif
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
                                <button class="btn square_btn_4 btn-block"><i
                                    class="fas fa-shopping-cart pr-2"></i>Add to cart </button>
                            </figcaption>
                        </div>
                    </div>
                </figure>
            </div> <!-- col.// -->
            @endforeach
        </div> <!-- row.// -->
        
        </div> <!-- container-fluid .//  -->
    </section>
        <!-- ========================= SECTION CONTENT END// ========================= -->
        
        
        
        <!-- ========================= SECTION CONTENT ========================= -->
    <section class="section-content padding-bottom-sm">
        <div class="container-fluid">
        
        <header class="section-heading">
            <a href="#" class="btn btn-outline-primary float-right">See all</a>
            <h3 class="section-title">Recommended</h3>
        </header><!-- sect-heading -->
        
        <div class="row">
            @foreach($products->where('featured', 1)->random(8) as $product)
            <div class="col-md-3">
                <figure class="card card-product-grid">
                    <div class="row">
                        <div class="col-md-12 col-5 p-r-0 center-responsive">
                            <div class="img-wrap img-fluid center"> 
                                @php $date = \Carbon\Carbon::today()->subDays(30); @endphp
                                @if($product->created_at >= $date)
                                <span class="badge badge-danger"> NEW </span>
                                @endif
                                @if ($product->images->count() > 0)
                                <img src="{{ asset('storage/'.$product->images->first()->images) }}">
                                @else
                                <img src="https://via.placeholder.com/176" alt="">
                                @endif
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
                                <button class="btn square_btn_4 btn-block"><i
                                    class="fas fa-shopping-cart pr-2"></i>Add to cart </button>
                            </figcaption>
                        </div>
                    </div>
                </figure>
            </div> <!-- col.// -->
            @endforeach
        </div>
        
        </div> <!-- container-fluid .//  -->
    </section>
        <!-- ========================= SECTION CONTENT END// ========================= -->
        
        <!-- ========================= SECTION  ========================= -->
    <section class="section-name bg padding-y-sm">
        <div class="container-fluid">
        <header class="section-heading">
            <h3 class="section-title">Our Brands</h3>
        </header><!-- sect-heading -->
        
        <div class="row">
            @foreach($brands as $brand)
            <div class="col-md-2 col-6">
                <figure class="box item-logo">
                    <a href="#"><img src="{{ asset('storage/'.$brand->logo)}}"></a>
                    <figcaption class="border-top pt-2">{{ $brand->products()->count() }} Products</figcaption>
                </figure> <!-- item-logo.// -->
            </div> <!-- col.// -->
            @endforeach
        </div> <!-- row.// -->
        </div><!-- container-fluid // -->
    </section>
        <!-- ========================= SECTION  END// ========================= -->
        
        
        
        <!-- ========================= SECTION  ========================= -->
    <section class="section-name padding-y">
        <div class="container-fluid">
        
        <h3 class="mb-3">Download app demo text</h3>
        
        <a href="#"><img src="{{ asset('storage/images/misc/appstore.png') }}" height="40"></a>
        <a href="#"><img src="{{ asset('storage/images/misc/appstore.png') }}" height="40"></a>
        
        </div><!-- container-fluid // -->
    </section>
    <!-- ========================= SECTION  END// ======================= -->
</div>
