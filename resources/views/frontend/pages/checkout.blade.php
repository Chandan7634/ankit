@extends('frontend.layouts.master')

@section('title', 'Checkout page')

@section('main-content')
    <main class="main">

        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> Checkout
                </div>
            </div>
        </div>
        <form method="POST" action="{{ route('cart.order') }}">
            @csrf
            <section class="mt-50 mb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-25">
                                <h4>Billing Details</h4>
                            </div>

                            <div class="form-group">
                                <input type="text" required="" name="first_name" value="{{ old('first_name') }}"
                                    placeholder="First name *">
                                @error('first_name')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" name="last_name" value="{{ old('lat_name') }}"
                                    placeholder="Last name *">
                                @error('last_name')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input required="" type="text" value="{{ old('phone') }}" name="phone"
                                    placeholder="Phone *">
                                @error('phone')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input required="" type="text" name="email" value="{{ old('email') }}"
                                    placeholder="Email address *">
                                @error('email')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="custom_select">
                                    <select name="country" class="form-select">
                                        <option selected value="India">India</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="address1" value="{{ old('address1') }}" required=""
                                    placeholder="Address *">
                                @error('address1')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ old('address2') }}" name="address2"
                                    placeholder="Address line 2 (optional)">
                                @error('address2')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input required="" type="text" name="post_code" value="{{ old('post_code') }}"
                                    placeholder="Postcode / ZIP *">
                                @error('post_code')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="order_review">
                                <div class="mb-20">
                                    <h4>Your Orders</h4>
                                </div>
                                <div class="table-responsive order_table text-center">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Product</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (App\Helpers\Helper::getAllProductFromCart())
                                                @foreach (App\Helpers\Helper::getAllProductFromCart() as $key => $cart)
                                                    <tr>
                                                        @php
                                                            $photo = explode(',', $cart->product['photo']);
                                                        @endphp
                                                        <td class="image product-thumbnail">
                                                            <img src="{{ Storage::url($photo[0]) }}"
                                                                alt="{{ $photo[0] }}">
                                                        </td>
                                                        <td>
                                                            <h5>
                                                                <a
                                                                    href="{{ route('product-detail', $cart->product['slug']) }}">
                                                                    {{ $cart->product['title'] }}
                                                                </a>
                                                            </h5>
                                                            <span class="product-qty">x {{ $cart['quantity'] }}</span>
                                                            @if ($cart->size)
                                                                <span class="font-xs text-muted d-block">Size:
                                                                    {{ $cart->size }}</span>
                                                            @endif
                                                        </td>
                                                        <td>&#8377;{{ number_format($cart['amount'], 2) }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                            <tr>
                                                <th>SubTotal</th>
                                                <td class="product-subtotal" colspan="2">
                                                    &#8377;{{ number_format(App\Helpers\Helper::totalCartPrice(), 2) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Shipping</th>
                                                <td colspan="2"><em>Free Shipping</em></td>
                                            </tr>
                                            @if (session('coupon'))
                                                <tr>
                                                    <th>You Save</th>
                                                    <td colspan="2" class="coupon_price"
                                                        data-price="{{ session('coupon')['value'] }}">
                                                        &#8377;{{ number_format(session('coupon')['value'], 2) }}</td>
                                                </tr>
                                            @endif
                                            @php
                                                $total_amount = App\Helpers\Helper::totalCartPrice();
                                                if (session('coupon')) {
                                                    $total_amount = $total_amount - session('coupon')['value'];
                                                }
                                            @endphp
                                            <tr>
                                                <th>Total</th>
                                                <td colspan="2" class="product-subtotal" id="order_total_price">
                                                    <span
                                                        class="font-xl text-brand fw-900">&#8377;{{ number_format($total_amount, 2) }}</span>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                <div class="payment_method">
                                    <div class="mb-25">
                                        <h5>Payment</h5>
                                    </div>
                                    <div class="payment_option">
                                        <div class="custome-radio">
                                            <input class="form-check-input" type="radio"
                                                name="payment_method" id="paymentCOD" value="cod" checked>
                                            <label class="form-check-label" for="paymentCOD">
                                                Cash On Delivery
                                            </label>
                                        </div>
                                        <p class="text-muted font-sm mt-10">
                                            <i class="fi-rs-truck mr-5"></i>
                                            Pay with cash when your order is delivered to your doorstep.
                                        </p>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-fill-out btn-block mt-30">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </main>
@endsection

