<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    @section('title', 'Cart')
    <!-- ========================= SECTION CONTENT ========================= -->
    <section class="section-content padding-y">
        <div class="container">
        
            <div class="row">
                <main class="col-md-9">
                    <div class="bg-white shadow-sm p-2 rounded">
                    
                    <div class="container border-bottom">
                    <div class="row pt-2">
                        <div class="col-10 text-left">
                        <h2 class="title-page">Shopping cart</h2>
                        </div>
                        <div class="col-2 text-right pt-4">
                        <p class="">price</p>
                        </div>
                    </div>
                    </div>
                    
                    
                    <div class="container">                        
                        @if (\Cart::isEmpty())
                        <p class="alert alert-warning">Your shopping cart is empty.</p>
                        @else
                            @foreach(\Cart::getContent() as $item)
                            <div class="row border-bottom pb-2">
                                <div class="col-md-2 col-3 center p-r-0">
                                <a href="{{ route('product.show', $item->associatedModel) }}"><img src="{{ $item->conditions }}" class="img-fluid"></a>
                                </div>
                                <div class="col-md-8 col-7 p-l-0">
                                <figcaption class="info">
                                    <h6 class="a-size-mini spacing-none line-clamp-2">
                                        <a href="{{ route('product.show', $item->associatedModel) }}" class="a-color on-hover">
                                        <span class="a-size-base-plus a-text-normal">
                                            {{ $item->name }}
                                        </span>
                                        </a>
                                    </h6>
                                    <dl class="dlist-inline small">
                                    @foreach($item->attributes as $key  => $value)
                                        <dd>{{ ucwords($value) }}</dd>
                                    @endforeach
                                    </dl>
                                    <div class="row">
                                    <div class="col-md-2 col-3 p-r-0">
                                        Qty: {{ $item->quantity }}
                                    </div>
                                    <div class="col-md-1 col-4 p-0 text-right">
                                        <a wire:click.prevent="delete({{ $item->id }})" class="small cursor-pointer">Delete</a>
                                    </div>
                                    {{-- <div class="col-md-2 col-5 p-0 text-right">
                                        <a wire:click.prevent="saveForLatter({{ $item->id }})" class="small">Save for latter</a>
                                    </div> --}}
                                    </div>
                                </figcaption>
                                </div>
                                <div class="col-md-2 col-2 text-right p-l-0">
                                    <var class="price">{{ config('settings.currency_symbol'). \Cart::get($item->id)->getPriceSum() }}</var> 
                                </div>
                            </div>
                            @endforeach           
                        @endif
                    
                    </div>
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                            <span>Subtotal ({{ \Cart::getTotalQuantity() }} item): <strong>{{ config('settings.currency_symbol') }}{{ \Cart::getSubTotal() }} </strong></span>
                            </div>
                        </div>
                    </div>  
                </div> <!-- card.// -->
                
                <div class="alert alert-success mt-3">
                    <p class="icontext"><i class="icon text-success fa fa-truck"></i> Free Delivery within 1-2 weeks</p>
                </div>
                
                </main> <!-- col.// -->
                <aside class="col-md-3">
                    <a wire:click="clearCart" class="btn btn-danger btn-block mb-4">Clear Cart</a>
                    <div class="bg-white shadow-sm rounded mb-3">
                        <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label>Have coupon?</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="" placeholder="Coupon code">
                                    <span class="input-group-append"> 
                                    <button class="btn btn-primary">Apply</button>
                                    </span>
                                </div>
                            </div>
                        </form>
                        </div> <!-- card-body.// -->
                    </div>  <!-- card .// -->
                    <div class="bg-white shadow-sm rounded">
                        <div class="card-body">
                            <dl class="dlist-align">
                                <dt>Subtotal price:</dt>
                                <dd class="text-right">{{ \Cart::getSubTotal() }}</dd>
                            </dl>
                            <dl class="dlist-align">
                                <dt>Discount:</dt>
                                <dd class="text-right"></dd>
                            </dl>
                            <dl class="dlist-align">
                                <dt>Total:</dt>
                                <dd class="text-right  h5"><strong>{{ \Cart::getTotal() }}</strong></dd>
                            </dl>
                            <div class="row">
                                <div class="col-12 text-center">
                                <a wire:click="checkOut" class="btn square_btn_5 cursor-pointer">Checkout</a>
                                </div>
                            </div>
                            <hr>
                            <p class="text-center mb-3">
                                {{-- <img src="images/misc/payments.png" height="26"> --}}
                            </p>
                            
                        </div> <!-- card-body.// -->
                    </div>  <!-- card .// -->
                </aside> <!-- col.// -->
            </div>
        </div> <!-- container .//  -->
    </section>
    <!-- ========================= SECTION CONTENT END// ========================= -->
    
    <!-- ========================= SECTION  ========================= -->
    <section class="section-name bg padding-y">
        <div class="container">
            <h6>Payment and refund policy</h6>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        
        </div><!-- container // -->
    </section>
</div>
