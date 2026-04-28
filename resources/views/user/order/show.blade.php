@extends('frontend.layouts.master')

@section('title', 'Order Detail')

@section('main-content')
<div class="card container py-3">
    <div class="card-body">
        @if ($order)
        <table class="table table-striped table-hover table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Qty.</th>
                    <th>Charge</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>₹{{ number_format($order->shipping?->price ?? 0, 2) }}</td>
                    <td>₹{{ number_format($order->total_amount, 2) }}</td>
                    <td>
                        @if ($order->status == 'new')
                        <span class="badge badge-primary">NEW</span>
                        @elseif($order->status == 'process')
                        <span class="badge badge-warning">PROCESSING</span>
                        @elseif($order->status == 'delivered')
                        <span class="badge badge-success">DELIVERED</span>
                        @else
                        <span class="badge text-dark badge-danger">{{ $order->status }}</span>
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('order.destroy', [$order->id]) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="dltBtn" data-id={{ $order->id }} data-toggle="tooltip" data-placement="bottom" title="Cancel">Cancle</button>
                        </form>
                    </td>

                </tr>
            </tbody>
        </table>

        <section class="ordered-products mt-4">
            <h5 class="font-weight-bold mb-3">Ordered Products</h5>
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->cart_info as $cart)
                    <tr>
                        <td>{{ $cart->product->title ?? 'N/A' }}</td>
                        <td>{{ $cart->quantity }}</td>
                        <td>₹{{ number_format($cart->price, 2) }}</td>
                        <td>₹{{ number_format($cart->price * $cart->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-right">Total:</th>
                        <th>₹{{ number_format($order->total_amount, 2) }}</th>
                    </tr>
                </tfoot>
            </table>
        </section>

        <section class="confirmation_part section_padding">
            <div class="order_boxes">
                <div class="row">
                    <div class="col-lg-6 col-lx-4">
                        <div class="order-info">
                            <h4 class="text-center pb-4">ORDER INFORMATION</h4>
                            <table class="table">
                                <tr class="">
                                    <td>Order Number</td>
                                    <td> : {{ $order->order_number }}</td>
                                </tr>
                                <tr>
                                    <td>Order Date</td>
                                    <td> : {{ $order->created_at->format('D d M, Y') }} at
                                        {{ $order->created_at->format('g : i a') }} </td>
                                </tr>
                                <tr>
                                    <td>Quantity</td>
                                    <td> : {{ $order->quantity }}</td>
                                </tr>
                                <tr>
                                    <td>Order Status</td>
                                    <td> : {{ $order->status }}</td>
                                </tr>
                                <tr>
                                    <td>Shipping Charge</td>
                                    <td> : ₹{{ number_format($order->shipping?->price ?? 0, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Total Amount</td>
                                    <td> : ₹{{ number_format($order->total_amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Payment Method</td>
                                    <td> :
                                        @if ($order->payment_method == 'cod')
                                        Cash on Delivery
                                        @elseif($order->payment_method == 'paypal')
                                        Paypal
                                        @elseif($order->payment_method == 'cardpay')
                                        Card Payment
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Payment Status</td>
                                    <td> :
                                        @if ($order->payment_status == 'paid')
                                        <span class="badge badge-success">Paid</span>
                                        @elseif($order->payment_status == 'unpaid')
                                        <span class="badge text-dark badge-danger">Unpaid</span>
                                        @else
                                        {{ $order->payment_status }}
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-6 col-lx-4">
                        <div class="shipping-info">
                            <h4 class="text-center pb-4">SHIPPING INFORMATION</h4>
                            <table class="table">
                                <tr class="">
                                    <td>Full Name</td>
                                    <td> : {{ $order->first_name }} {{ $order->last_name }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td> : {{ $order->email }}</td>
                                </tr>
                                <tr>
                                    <td>Phone No.</td>
                                    <td> : {{ $order->phone }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td> : {{ $order->address1 }}, {{ $order->address2 }}</td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td> : {{ $order->country }}</td>
                                </tr>
                                <tr>
                                    <td>Post Code</td>
                                    <td> : {{ $order->post_code }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

    </div>
</div>
@endsection

@push('styles')
<style>
    .order-info,
    .shipping-info {
        background: #ECECEC;
        padding: 20px;
    }

    .order-info h4,
    .shipping-info h4 {
        text-decoration: underline;
    }

</style>
@endpush
