<div>
    @section('title', 'Order Details')
    {{-- The Master doesn't talk, he acts. --}}
    <!-- Page Heading -->
    <div class="d-flex align-items-center flex-row-reverse mb-4">
        <button wire:click="completed" 
        class="d-inline-block btn btn-sm btn-success mx-2 shadow-sm" {{ $order->status=='Completed' ? 'disabled' : ''}}>Completed</button>
        <button wire:click="outForDelivery" 
        class="d-inline-block btn btn-sm {{ $order->status=='In delivery' ? 'btn-secondary disabled' : 'btn-warning'}} mx-2 shadow-sm" {{ $order->status=='Completed' ? 'disabled' : ''}}>Order out for delevery</button>
        <button  wire:click="placeOrder"
        class="d-inline-block btn btn-sm {{ $order->status=='Placed' ? 'btn-secondary disabled' : 'btn-info'}} mx-2 shadow-sm" {{ $order->status=='Completed' ? 'disabled' : ''}}>Place Order</button>
        <button wire:click="exportPDF" 
        class="d-inline-block btn btn-sm btn-primary mx-2 shadow-sm">Export PDF</button>
    </div>
    <div class="card card-body rounded shadow-sm">
        <div class="row">
            <div class="col-md-12">
                <div class="cart">
                    <section class="invoice">
                        <div class="row mb-4">
                            <div class="col-6">
                                <h2 class="page-header"><i class="fa fa-globe"></i> {{ $order->order_number }}</h2>
                            </div>
                            <div class="col-6">
                                <h5 class="text-right">Date: {{ $order->created_at->toFormattedDateString() }}</h5>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <div class="col-4">Placed By
                                <address><strong>{{ $order->user->name }}</strong><br>Email: {{ $order->user->email }}</address>
                            </div>
                            <div class="col-4">Ship To
                                <address><strong>{{ $order->name }}</strong><br>{{ $order->address }}<br>{{ $order->city }}, {{ $order->country }} {{ $order->post_code }}<br>{{ $order->phone_number }}<br></address>
                            </div>
                            <div class="col-4">
                                <b>Order ID:</b> {{ $order->order_number }}<br>
                                <b>Amount:</b> {{ config('settings.currency_symbol') }}{{ round($order->grand_total, 2) }}<br>
                                <b>Payment Method:</b> {{ $order->payment_method }}<br>
                                <b>Payment Status:</b> {{ $order->payment_status == 1 ? 'Completed' : 'Not Completed' }}<br>
                                <b>Order Status:</b> {{ $order->status }}<br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Product</th>
                                        <th>SKU #</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $key => $item)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $item->product->name }}</td>
                                                <td>{{ $item->product->sku }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ config('settings.currency_symbol') }}{{ round($item->price, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
