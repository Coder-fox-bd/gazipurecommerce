<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    @section('title', 'Account')
    <section class="section-content padding-y" style="min-height: 80vh;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4>Your Account</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-12 mb-3">
                    <a href="{{ route('account.orders') }}" class="a-color on-hover">
                        <div class="card p-3 hover-dark">
                            <div class="row pt-3 pb-3">
                                <div class="col-3 center">
                                    <img class="img-fluid" src="{{ asset('storage/images/order.png') }}" alt="">
                                </div>
                                <div class="col-9">
                                    <h5>Your Orders</h5>
                                    <p>Track, return, or buy things</p>
                                </div>
                            </div>
                        </div>
                     </a>
                </div>
                <div class="col-md-4 col-12 mb-3">
                    <a href="{{ route('account.security') }}" class="a-color on-hover">
                        <div class="card p-3 hover-dark">
                            <div class="row pt-3 pb-3">
                                <div class="col-3 center">
                                    <img class="img-fluid" src="{{ asset('storage/images/security.png') }}" alt="">
                                </div>
                                <div class="col-9">
                                    <h5>Login & security</h5>
                                    <p>Edit name, change password</p>
                                </div>
                            </div>
                        </div>
                     </a>
                </div>
            </div>
        </div>
    </section>

</div>
