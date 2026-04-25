@extends('frontend.layouts.master')
@push('styles')
    <style>
        .main .button.button.btn-small:hover {
            background-color: #fff !important;
            color: #333 !important;
        }
    </style>
@endpush
@section('main-content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow">Home</a>
                    <span></span> Account

                </div>
            </div>
        </div>
        <section class="pt-10 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="col-md-12">
                            @include('user.layouts.notification')
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                @include('user.layouts.sidebar')
                            </div>
                            <div class="col-md-8">
                                <div class="tab-content dashboard-content">
                                    <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                        aria-labelledby="dashboard-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">Your Orders</h5>
                                            </div>
                                            @php
                                                $orders = DB::table('orders')
                                                    ->where('user_id', auth()->user()->id)
                                                    ->get();
                                            @endphp
                                            @if (count($orders) > 0)
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Order No.</th>
                                                                    {{-- <th>Name</th>
                                                                    <th>Email</th> --}}
                                                                    <th>Qty.</th>
                                                                    {{-- <th>Charge</th> --}}
                                                                    <th>Total</th>
                                                                    <th>Status</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $counter = 1;
                                                                @endphp
                                                                @foreach ($orders as $order)
                                                                    <tr>
                                                                        <td>{{ $counter }}</td>
                                                                        <td>{{ $order->order_number }}</td>
                                                                        {{-- <td>{{ $order->first_name }} {{ $order->last_name }}
                                                                        </td>
                                                                        <td>{{ $order->email }}</td> --}}
                                                                        <td>{{ $order->quantity }}</td>
                                                                        {{-- <td>${{ $order->shipping->price }}</td> --}}
                                                                        <td>&#8377;{{ number_format($order->total_amount, 2) }}
                                                                        </td>
                                                                        <td>
                                                                            @if ($order->status == 'new')
                                                                                <span class="">NEW</span>
                                                                            @elseif($order->status == 'process')
                                                                                <span class="">PROCESSING</span>
                                                                            @elseif($order->status == 'delivered')
                                                                                <span class="">DELIVERED</span>
                                                                            @else
                                                                                <span
                                                                                    class="">{{ $order->status }}</span>
                                                                            @endif
                                                                        </td>
                                                                        <td
                                                                            class="d-flex gap-3 align-items-center justify-content-center">
                                                                            <a href="{{ route('user.order.show', $order->id) }}"
                                                                                class="btn-small d-block"> Show </a>
                                                                            <form method="POST"
                                                                                action="{{ route('user.order.delete', [$order->id]) }}">
                                                                                @csrf
                                                                                @method('delete')
                                                                                <button type="submit"
                                                                                    class="btn-small d-block p-0 bg-white border-0 text-dark"
                                                                                    data-id={{ $order->id }}> Cancel
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                    @php
                                                                        $counter++;
                                                                    @endphp
                                                                @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            @else
                                                <h4 class="text-center my-5">No orders found!!! Please order some products
                                                </h4>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">Your Orders</h5>
                                            </div>
                                            @php
                                                $orders = DB::table('orders')
                                                    ->where('user_id', auth()->user()->id)
                                                    ->get();
                                            @endphp
                                            @if (count($orders) > 0)
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Order No.</th>
                                                                    {{-- <th>Name</th>
                                                                    <th>Email</th> --}}
                                                                    <th>Qty.</th>
                                                                    {{-- <th>Charge</th> --}}
                                                                    <th>Total</th>
                                                                    <th>Status</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $counter = 1;
                                                                @endphp
                                                                @foreach ($orders as $order)
                                                                    <tr>
                                                                        <td>{{ $counter }}</td>
                                                                        <td>{{ $order->order_number }}</td>
                                                                        {{-- <td>{{ $order->first_name }} {{ $order->last_name }}
                                                                        </td>
                                                                        <td>{{ $order->email }}</td> --}}
                                                                        <td>{{ $order->quantity }}</td>
                                                                        {{-- <td>${{ $order->shipping->price }}</td> --}}
                                                                        <td>&#8377;{{ number_format($order->total_amount, 2) }}
                                                                        </td>
                                                                        <td>
                                                                            @if ($order->status == 'new')
                                                                                <span class="">NEW</span>
                                                                            @elseif($order->status == 'process')
                                                                                <span class="">PROCESSING</span>
                                                                            @elseif($order->status == 'delivered')
                                                                                <span class="">DELIVERED</span>
                                                                            @else
                                                                                <span
                                                                                    class="">{{ $order->status }}</span>
                                                                            @endif
                                                                        </td>
                                                                        <td
                                                                            class="d-flex gap-3 align-items-center justify-content-center">
                                                                            <a href="{{ route('user.order.show', $order->id) }}"
                                                                                class="btn-small d-block"> Show </a>
                                                                            <form method="POST"
                                                                                action="{{ route('user.order.delete', [$order->id]) }}">
                                                                                @csrf
                                                                                @method('delete')
                                                                                <button type="submit"
                                                                                    class="btn-small d-block p-0 bg-white border-0 text-dark"
                                                                                    data-id={{ $order->id }}> Cancel
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                    @php
                                                                        $counter++;
                                                                    @endphp
                                                                @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            @else
                                                <h4 class="text-center my-5">No orders found!!! Please order some products
                                                </h4>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="track-orders" role="tabpanel"
                                        aria-labelledby="track-orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">Orders tracking</h5>
                                            </div>
                                            <div class="card-body contact-from-area">
                                                <p>To track your order please enter your OrderID in the box below and press
                                                    "Track" button. This was given to you on your receipt and in the
                                                    confirmation email you should have received.</p>
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <form {{ route('product.track.order') }} novalidate="novalidate"
                                                            method="POST" class="contact-form-style mt-30 mb-50">
                                                            @csrf
                                                            <div class="input-style mb-20">
                                                                <label>Order ID</label>
                                                                <input name="order_number"
                                                                    placeholder="Enter your order number" type="text"
                                                                    class="square">
                                                            </div>
                                                            <button class="submit submit-auto-width"
                                                                type="submit">Track</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="card mb-3 mb-lg-0">
                                                    <div class="card-header">
                                                        <h5 class="mb-0">Billing Address</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <address>3522 Interstate<br> 75 Business Spur,<br> Sault Ste.
                                                            <br>Marie, MI 49783
                                                        </address>
                                                        <p>New York</p>
                                                        <a href="#" class="btn-small">Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="mb-0">Shipping Address</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <address>4299 Express Lane<br>
                                                            Sarasota, <br>FL 34249 USA <br>Phone: 1.941.227.4444</address>
                                                        <p>Sarasota</p>
                                                        <a href="#" class="btn-small">Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="account-detail" role="tabpanel"
                                        aria-labelledby="account-detail-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Change Password</h5>
                                            </div>
                                            <div class="card-body">
                                                {{-- <p>Already have an account? <a href="page-login-register.html">Log in
                                                        instead!</a></p> --}}
                                                <form method="POST" action="{{ route('change.password') }}" name="enq">
                                                    @csrf

                                                    @foreach ($errors->all() as $error)
                                                        <p class="text-danger">{{ $error }}</p>
                                                    @endforeach
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="password">Current Password <span
                                                                    class="required">*</span></label>
                                                            <input required="" id="password" type="password"
                                                                class="form-control square" name="current_password"
                                                                autocomplete="current-password">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>New Password <span class="required">*</span></label>
                                                            <input required="" id="new_password" type="password"
                                                                class="form-control square" name="new_password"
                                                                autocomplete="current-password">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>New Confirm Password<span
                                                                    class="required">*</span></label>
                                                            <input id="new_confirm_password" type="password"
                                                                required="" class="form-control square"
                                                                name="new_confirm_password"
                                                                autocomplete="current-password">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-fill-out submit"
                                                                name="submit" value="Submit">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
