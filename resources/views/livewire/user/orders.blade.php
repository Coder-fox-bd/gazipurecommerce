<div>
    <link rel="stylesheet" href="">
    <style>
    .card {
        z-index: 0;
        background-color: #ECEFF1;
        padding-bottom: 20px;
        margin-top: 90px;
        margin-bottom: 90px;
        border-radius: 10px
    }

    .top {
        padding-top: 40px;
        padding-left: 13% !important;
        padding-right: 13% !important
    }

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: #455A64;
        padding-left: 0px;
        margin-top: 30px
    }

    #progressbar li {
        list-style-type: none;
        font-size: 13px;
        width: 25%;
        float: left;
        position: relative;
        font-weight: 400
    }

    #progressbar .step0:before {
        font-family: FontAwesome;
        content: "\f1ce";
        color: #fff
    }

    #progressbar li:before {
        width: 40px;
        height: 40px;
        line-height: 45px;
        display: block;
        font-size: 20px;
        background: #C5CAE9;
        border-radius: 50%;
        margin: auto;
        padding: 0px
    }

    #progressbar li:after {
        content: '';
        width: 100%;
        height: 12px;
        background: #C5CAE9;
        position: absolute;
        left: 0;
        top: 16px;
        z-index: -1
    }

    #progressbar li:last-child:after {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        position: absolute;
        left: -50%
    }

    #progressbar li:nth-child(2):after,
    #progressbar li:nth-child(3):after {
        left: -50%
    }

    #progressbar li:first-child:after {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        position: absolute;
        left: 50%
    }

    #progressbar li:last-child:after {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px
    }

    #progressbar li:first-child:after {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #651FFF
    }

    #progressbar li.active:before {
        font-family: "Font Awesome 5 Free"; 
        content: "\f00c"
    }

    .icon {
        width: 60px;
        height: 60px;
        margin-right: 15px
    }

    .icon-content {
        padding-bottom: 20px
    }

    @media screen and (max-width: 992px) {
        .icon-content {
            width: 20%
        }
    }
    </style>
    {{-- In work, do what you enjoy. --}}
    @section('title', 'Orders')
    <div class="container padding-y">
        <h2 class="title-page">Your Orders</h2>
    </div>
    <section class="section-content border-top" style="min-height: 60vh;">
        <div class="container">
            <div class="row">
            </div>
            <div class="row">
                <main class="col-sm-12 table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Order No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Order Amount</th>
                                <th scope="col">Qty.</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <th scope="row">{{ $order->order_number }}</th>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ config('settings.currency_symbol') }}{{ round($order->grand_total, 2) }}</td>
                                    <td>{{ $order->item_count }}</td>
                                    <td><span class="badge badge-success">{{ strtoupper($order->status) }}</span></td>
                                </tr>

                                {{-- <div class="container px-1 px-md-4 py-5 mx-auto">
                                    <div class="card">
                                        <div class="row d-flex justify-content-between px-3 top">
                                            <div class="d-flex">
                                                <h5>ORDER <span class="text-primary font-weight-bold">#Y34XDHR</span></h5>
                                            </div>
                                            <div class="d-flex flex-column text-sm-right">
                                                <p class="mb-0">Expected Arrival <span>01/12/19</span></p>
                                                <p>USPS <span class="font-weight-bold">234094567242423422898</span></p>
                                            </div>
                                        </div> <!-- Add class 'active' to progress -->
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-12">
                                                <ul id="progressbar" class="text-center">
                                                    <li class="active step0"></li>
                                                    <li class="active step0"></li>
                                                    <li class="active step0"></li>
                                                    <li class="step0"></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="row justify-content-between top">
                                            <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/9nnc9Et.png">
                                                <div class="d-flex flex-column">
                                                    <p class="font-weight-bold">Order<br>Processed</p>
                                                </div>
                                            </div>
                                            <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/u1AzR7w.png">
                                                <div class="d-flex flex-column">
                                                    <p class="font-weight-bold">Order<br>Shipped</p>
                                                </div>
                                            </div>
                                            <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/TkPm63y.png">
                                                <div class="d-flex flex-column">
                                                    <p class="font-weight-bold">Order<br>En Route</p>
                                                </div>
                                            </div>
                                            <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/HdsziHP.png">
                                                <div class="d-flex flex-column">
                                                    <p class="font-weight-bold">Order<br>Arrived</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                            @empty
                                <div class="col-sm-12">
                                    <p class="alert alert-warning">No orders to display.</p>
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </main>
            </div>
        </div>
    </section>
</div>
