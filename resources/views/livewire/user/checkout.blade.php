<div>
    {{-- Stop trying to control. --}}
    @section('title', 'Checkout')
    {{-- <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">Checkout</h2>
        </div>
    </section> --}}
    <section class="section-content padding-y">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @if (Session::has('error'))
                        <p class="alert alert-danger">{{ Session::get('error') }}</p>
                    @endif
                </div>
            </div>
            <form wire:submit.prevent="storeOrderDetails(Object.fromEntries(new FormData($event.target)))" method="POST" role="form">
                <div class="row">
                    <div class="col-md-8">
                        <div class="bg-white shadow-sm p-3 rounded mb-4">
                            <h4 class="card-title mt-2">Billing Details</h4>
                            <article class="card-body">
                                <div class="form-row">
                                    <div class="col form-group">
                                        <label>First name</label>
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name">
                                    </div>
                                    <div class="col form-group">
                                        <label>Last name</label>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>City</label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror" name="city">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Country</label>
                                        <input type="text" class="form-control @error('country') is-invalid @enderror" name="country">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group  col-md-6">
                                        <label>Post Code</label>
                                        <input type="text" class="form-control @error('post_code') is-invalid @enderror" name="post_code">
                                    </div>
                                    <div class="form-group  col-md-6">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" disabled>
                                    <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label>Order Notes</label>
                                    <textarea class="form-control" name="notes" rows="6"></textarea>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bg-white shadow-sm p-3 rounded">
                                    <h4 class="card-title mt-2">Your Order</h4>
                                    <article class="card-body">
                                        <dl class="dlist-align">
                                            <dt>Total cost: </dt>

                                            <dd class="text-right h5 b"> {{ config('settings.currency_symbol') }} {{ $total }} </dd>
                                        </dl>
                                    </article>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1" checked disabled>
                                        <label class="custom-control-label" for="customCheck1">Cash on delivery</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <button type="submit" class="subscribe btn square_btn_5 btn-lg btn-block">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
