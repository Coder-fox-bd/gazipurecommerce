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
                                @foreach($carousel->where('status', 1) as $key => $slider)
                                <div class="carousel-item {{$key == 0 ? 'active' : '' }} img-gradient">
                                    <a href="{{ $slider->offer_url }}">
                                        {{-- {{ $slider->collections }} --}}
                                        <img class="img-fluid" src="{{ asset('storage/'.$slider->images) }}" alt="Image slide">
                                    </a>
                                </div>
                                @endforeach
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
                    <div class="card-banner" style="height:250px; background-image: url('{{ $category->getFirstMediaUrl('categories') }}');">
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
            @foreach($new as $product)
            @include('livewire.user.partials.product-col-3')
            @endforeach
        </div> <!-- row.// -->
        
        </div> <!-- container-fluid .//  -->
    </section>
        <!-- ========================= SECTION CONTENT END// ========================= -->
        
        
        
        <!-- ========================= SECTION CONTENT ========================= -->
    <section class="section-content padding-bottom-sm">
        <div class="container-fluid">
        
        <header class="section-heading">
            <a href="#" class="btn btn-outline-warning float-right">See all</a>
            <h3 class="section-title">Recommended</h3>
        </header><!-- sect-heading -->
        
        <div class="row">
            @foreach($recomended as $product)
            @include('livewire.user.partials.product-col-3')
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
                    <a href="{{ route('brand', $brand->slug ) }}">{{ $brand->getFirstMedia('brands') }}</a>
                </figure> <!-- item-logo.// -->
            </div> <!-- col.// -->
            @endforeach
        </div> <!-- row.// -->
        </div><!-- container-fluid // -->
    </section>
        <!-- ========================= SECTION  END// ========================= -->
        
        
        
        <!-- ========================= SECTION  ========================= -->
    {{-- <section class="section-name padding-y">
        <div class="container-fluid">
        
        <h3 class="mb-3">Download app demo text</h3>
            <div class="test">

    </div>
        <a href="#"><img src="{{ asset('storage/images/misc/appstore.png') }}" height="40"></a>
        <a href="#"><img src="{{ asset('storage/images/misc/appstore.png') }}" height="40"></a>
        
        </div><!-- container-fluid // -->
    </section> --}}

    <!-- ========================= SECTION  END// ======================= -->
    {{-- @section('js')
        <script>
            $.get("{!! route('carousel-pc') !!}", function (data) {
                $.each(data,function(index,value){
                    $(".carousel-inner").append(
                        '<div class="carousel-item active img-gradient">' +
                            '<a href="#">' +
                                '<img class="img-fluid" src="{{ asset('storage/') }}/'+data[index].images+'" id="carousel-img" alt="Image slide">' +
                            '</a>' +
                        '</div>'
                    );
                    // $( '.carousel-inner').find('.carousel-item:first' ).addClass( 'active' );
                });
            });
        </script>
    @endsection --}}
</div>
