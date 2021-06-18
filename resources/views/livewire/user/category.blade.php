<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <!-- ========================= SECTION PAGETOP ========================= -->
    <div class="container-fluid">
        <nav>
            <ol class="breadcrumb text-white">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                @if($category->parent)
                    <li class="breadcrumb-item"><a href="{{ route('category.show', $category->parent->slug) }}">{{ $category->parent->name }}</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
            </ol>  
        </nav>
    </div>
    <!-- ========================= SECTION INTRO END// ========================= -->
    <!-- ========================= SECTION CONTENT ========================= -->
    <section class="section-content">
        <div class="container-fluid">

            <div class="row">
                @include('user.partials.filter')
                <main class="col-md-9">

                    <header class="border-bottom mb-4 pb-3">
                            <div class="form-inline">
                                <span class="mr-md-auto">32 Items found </span>
                                <select class="mr-2 form-control">
                                    <option>Latest items</option>
                                    <option>Trending</option>
                                    <option>Most Popular</option>
                                    <option>Cheapest</option>
                                </select>
                            </div>
                    </header><!-- sect-heading -->

                    <div class="row">
                        @forelse($products->shuffle() as $product)
                        <div class="col-md-4">
                            <figure class="card card-product-grid">
                                <div class="row">
                                    <div class="col-md-12 col-5 p-r-0 center-responsive">
                                        <div class="img-wrap img-fluid center"> 
                                            @php $date = \Carbon\Carbon::today()->subDays(15); @endphp
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
                                            <div class="price mt-1">{{ $product->special_price }}</div> <!-- price-wrap.// -->
                                            <div class="price-old mt-1"><span class="line-through">{{ $product->price }}</span></div> <!-- price-wrap.// -->
                                            @else
                                            <div class="price mt-1">{{ $product->price }}</div> <!-- price-wrap.// -->
                                            @endif
                                            <a href="#" class="square_btn_4 btn-block"><i
                                                class="fas fa-shopping-cart pr-2"></i>Add to cart </a>
                                        </figcaption>
                                    </div>
                                </div>
                            </figure>
                        </div> <!-- col.// -->
                        @empty
                        <p>No Products found in {{ $category->name }}.</p>
                        @endforelse
                        <div class="col-12 d-flex justify-content-center">
                            {{ $products->links() }}
                        </div> 
                    </div> <!-- row end.// -->

                </main> <!-- col.// -->

            </div>

        </div> <!-- container .//  -->
    </section>

    @section('js')
    <script>
        function updateTextInput(val) {
            document.getElementById('range-output').value=val; 
        }
    </script>
    @endsection
</div>
