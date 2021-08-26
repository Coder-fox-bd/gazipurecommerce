<div>
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
