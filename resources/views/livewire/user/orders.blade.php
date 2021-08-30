<div>
    <link rel="stylesheet" href="">
    <style>
    .bg-not-completed {
        background-color: #ECEFF1;
    }
    .bs4-order-tracking {
        margin-bottom: 30px;
        overflow: hidden;
        color: #878788;
        padding-left: 0px;
        margin-top: 5px
    }

    .bs4-order-tracking li {
        list-style-type: none;
        font-size: 13px;
        width: 25%;
        float: left;
        position: relative;
        font-weight: 400;
        color: #878788;
        text-align: center
    }

    .bs4-order-tracking li:first-child:before {
        margin-left: 15px !important;
        padding-left: 11px !important;
        text-align: left !important
    }

    .bs4-order-tracking li:last-child:before {
        margin-right: 5px !important;
        padding-right: 11px !important;
        text-align: right !important
    }

    .bs4-order-tracking li>div {
        color: #fff;
        width: 29px;
        text-align: center;
        line-height: 29px;
        display: block;
        font-size: 12px;
        background: #878788;
        border-radius: 50%;
        margin: auto
    }

    .bs4-order-tracking li:after {
        content: '';
        width: 150%;
        height: 2px;
        background: #878788;
        position: absolute;
        left: 0%;
        right: 0%;
        top: 15px;
        z-index: -1
    }

    .bs4-order-tracking li:first-child:after {
        left: 50%
    }

    .bs4-order-tracking li:last-child:after {
        left: 0% !important;
        width: 0% !important
    }

    .bs4-order-tracking li.active {
        font-weight: bold;
        color: #dc3545
    }

    .bs4-order-tracking li.active>div {
        background: #dc3545
    }

    .bs4-order-tracking li.active:after {
        background: #dc3545
    }

    .card-timeline {
        z-index: 0
    }
    </style>
    {{-- In work, do what you enjoy. --}}
    @section('title', 'Orders')
    <div class="container padding-y">
        <h2 class="title-page">Your Orders</h2>
    </div>
    <section class="section-content" style="min-height: 60vh;">
        <div class="container">
            @forelse ($orders as $order)
            <div class="card card-timeline border-none {{ $order->status!='Completed' ? 'bg-not-completed' : ''}} mb-3">
                <div class="row d-flex justify-content-between px-md-5 px-4 pt-md-5 pt-4 top">
                    <div class="d-flex">
                        <h5><span class="text-primary font-weight-bold">{{ $order->order_number }}</span></h5>
                    </div>
                    <div class="d-flex flex-column text-sm-right">
                        @php $date = $order->created_at; $daysToAdd = 5; $date = $date->addDays($daysToAdd); @endphp
                        <p class="mb-0">Expected Arrival <span>{{ $date->toFormattedDateString() }}</span></p>
                        {{-- <p>USPS <span class="font-weight-bold">234094567242423422898</span></p> --}}
                    </div>
                </div> <!-- Add class 'active' to progress -->
                @if ($order->status == 'Pending')
                <ul class="bs4-order-tracking">
                    <li class="step ">
                        <div><i class="fas fa-user"></i></div> Order Placed
                    </li>
                    <li class="step ">
                        <div><i class="fas fa-bread-slice"></i></div> In transit
                    </li>
                    <li class="step ">
                        <div><i class="fas fa-truck"></i></div> Out for delivery
                    </li>
                    <li class="step ">
                        <div><i class="fas fa-birthday-cake"></i></div> Delivered
                    </li>
                </ul>
                <h5 class="text-center pb-2"><b>Pending</b>. The order not been accepted yet!</h5>
                @elseif ($order->status == 'Placed')
                <ul class="bs4-order-tracking">
                    <li class="step active">
                        <div><i class="fas fa-user"></i></div> Order Placed
                    </li>
                    <li class="step active">
                        <div><i class="fas fa-bread-slice"></i></div> In transit
                    </li>
                    <li class="step ">
                        <div><i class="fas fa-truck"></i></div> Out for delivery
                    </li>
                    <li class="step ">
                        <div><i class="fas fa-birthday-cake"></i></div> Delivered
                    </li>
                </ul>
                <h5 class="text-center pb-2"><b>In transit</b>. This order has been shipped!</h5>
                @elseif($order->status == 'In delivery')
                <ul class="bs4-order-tracking">
                    <li class="step active">
                        <div><i class="fas fa-user"></i></div> Order Placed
                    </li>
                    <li class="step active">
                        <div><i class="fas fa-bread-slice"></i></div> In transit
                    </li>
                    <li class="step active">
                        <div><i class="fas fa-truck"></i></div> Out for delivery
                    </li>
                    <li class="step ">
                        <div><i class="fas fa-birthday-cake"></i></div> Delivered
                    </li>
                </ul>
                <h5 class="text-center pb-2"><b>In delivery</b>. This order out for delivery!</h5>
                @else
                <ul class="bs4-order-tracking">
                    <li class="step active">
                        <div><i class="fas fa-user"></i></div> Order Placed
                    </li>
                    <li class="step active">
                        <div><i class="fas fa-bread-slice"></i></div> In transit
                    </li>
                    <li class="step active">
                        <div><i class="fas fa-truck"></i></div> Out for delivery
                    </li>
                    <li class="step active">
                        <div><i class="fas fa-birthday-cake"></i></div> Delivered
                    </li>
                </ul>
                <h5 class="text-center pb-2"><b>Completed</b>. This order been delivered!</h5>
                @endif
            </div>
            @empty
                <div class="col-sm-12">
                    <p class="alert alert-warning">No orders to display.</p>
                </div>
            @endforelse

            {{-- <div class="row">
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
                                    <th scope="row"><i class="fas fa-check"></i>{{ $order->order_number }}</th>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ config('settings.currency_symbol') }}{{ round($order->grand_total, 2) }}</td>
                                    <td>{{ $order->item_count }}</td>
                                    <td><span class="badge badge-success">{{ strtoupper($order->status) }}</span></td>
                                </tr>

                            @empty
                                <div class="col-sm-12">
                                    <p class="alert alert-warning">No orders to display.</p>
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </main>
            </div> --}}
        </div>
    </section>
</div>
