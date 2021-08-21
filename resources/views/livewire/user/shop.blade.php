<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    @section('title', 'Shop')
        <!-- ========================= SECTION PAGETOP ========================= -->
        <div class="container-fluid">
            <nav>
                <ol class="breadcrumb text-white">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shop</li>
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
                                <span class="mr-md-auto">{{ $products->count() }} Items found </span>
                                <select class="mr-2 form-control">
                                    <option>Latest items</option>
                                    <option>Trending</option>
                                    <option>Most Popular</option>
                                    <option>Cheapest</option>
                                </select>
                            </div>
                    </header><!-- sect-heading -->

                    <div class="row">
                        @forelse($products as $product)
                        @include('livewire.user.partials.product-col-4')
                        @empty
                        <p>No Products found in Shop.</p>
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
