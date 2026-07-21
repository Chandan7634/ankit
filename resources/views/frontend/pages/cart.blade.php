@extends('frontend.layouts.master')
@section('title', 'Cart Page')
@section('main-content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> Your Cart
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('cart.update') }}" method="POST">
                            @csrf
                            <div class="table-responsive">
                                <table class="table shopping-summery text-center clean">
                                    <thead>
                                        <tr class="main-heading">
                                            <th scope="col">Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Subtotal</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cart_item_list">

                                        @if (App\Helpers\Helper::getAllProductFromCart())
                                            @foreach (App\Helpers\Helper::getAllProductFromCart() as $key => $cart)
                                                <tr>
                                                    @php
                                                        $photo = explode(',', $cart->product['photo']);
                                                    @endphp
                                                    <td class="image product-thumbnail"><img
                                                            src="{{ Storage::url($photo[0]) }}" alt="{{ $photo[0] }}">
                                                    </td>
                                                    <td class="product-des product-name">
                                                        <h5 class="product-name">
                                                            <a href="{{ route('product-detail', $cart->product['slug']) }}">
                                                                {{ $cart->product['title'] }}
                                                            </a>
                                                        </h5>
                                                        @if ($cart->size)
                                                            <p class="font-xs text-muted mb-0">Size: {{ $cart->size }}</p>
                                                        @endif
                                                        {{-- <p class="font-xs">Maboriosam in a tonto nesciung eget<br> distingy
                                                            magndapibus.
                                                        </p> --}}
                                                    </td>
                                                    <td class="price" data-title="Price"><span>
                                                            &#8377; {{ number_format($cart['amount'], 2) }}</span></td>
                                                    <td class="text-center" data-title="Stock">
                                                        <div class="detail-qty border radius  m-auto">
                                                            <a href="#" class="qty-down2"><i
                                                                    class="fi-rs-angle-small-down"></i></a>
                                                            <span class="qty-val2">{{ $cart->quantity }}</span>
                                                            <a href="#" class="qty-up2"><i
                                                                    class="fi-rs-angle-small-up"></i></a>
                                                            <input type="hidden" name="qty_id[]"
                                                                value="{{ $cart->id }}">
                                                            <input type="hidden" class="main_count" name="quant[]"
                                                                value="{{ $cart->quantity }}">
                                                        </div>
                                                    </td>
                                                    <td class="text-right" data-title="Cart">
                                                        <span>&#8377;{{ number_format($cart['price']) }}</span>
                                                    </td>
                                                    <td class="action" data-title="Remove">
                                                        <a href="{{ route('cart-delete', $cart->id) }}" class="text-muted">
                                                            <i class="fi-rs-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="text-center">
                                                    There are no any carts available. <a
                                                        href="{{ route('product-grids') }}" style="color:blue;">Continue
                                                        shopping</a>

                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart-action text-end">
                                <button type="submit" class="btn  mr-10 mb-sm-15">
                                    <i class="fi-rs-shuffle mr-10"></i>
                                    Update Cart
                                </button>
                                <a class="btn" href="{{ route('product-grids') }}">
                                    <i class="fi-rs-shopping-bag mr-10"></i>
                                    Continue Shopping
                                </a>
                            </div>
                        </form>
                        <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                        <div class="row mb-50">
                            <div class="col-lg-6 col-md-12">
                                <div class="mb-30 mt-50">
                                    <div class="heading_s1 mb-3">
                                        <h4>Apply Coupon</h4>
                                    </div>
                                    <div class="total-amount">
                                        <div class="left">
                                            <div class="coupon">
                                                <form action="{{ route('coupon-store') }}" method="POST">
                                                    @csrf
                                                    <div class="form-row row justify-content-center">
                                                        <div class="form-group col-lg-6">
                                                            <input class="font-medium" name="code"
                                                                placeholder="Enter Your Coupon">
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <button type="submit" class="btn  btn-sm"><i
                                                                    class="fi-rs-label mr-10"></i>Apply</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="border p-md-4 p-30 border-radius cart-totals">
                                    <div class="heading_s1 mb-3">
                                        <h4>Cart Totals</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="cart_total_label">Cart Subtotal</td>
                                                    <td class="cart_total_amount">
                                                        <span class="order_subtotal font-lg fw-900 text-brand"
                                                            data-price="{{ App\Helpers\Helper::totalCartPrice() }}">
                                                            &#8377;{{ number_format(App\Helpers\Helper::totalCartPrice(), 2) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    @if (session()->has('coupon'))
                                                        <td class="cart_total_label">Coupon</td>
                                                        <td class="coupon_price"
                                                            data-price="{{ Session::get('coupon')['value'] }}">You
                                                            Save<span>&#8377;{{ number_format(Session::get('coupon')['value'], 2) }}</span>
                                                        </td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Shipping</td>
                                                    <td class="cart_total_amount"> <i class="ti-gift mr-5"></i> Free
                                                        Shipping</td>
                                                </tr>
                                                @php
                                                    $total_amount = App\Helpers\Helper::totalCartPrice();
                                                    if (session()->has('coupon')) {
                                                        $total_amount = $total_amount - Session::get('coupon')['value'];
                                                    }
                                                @endphp
                                                <tr>
                                                    @if (session()->has('coupon'))
                                                        <td class="cart_total_label">Total</td>
                                                        <td class="cart_total_amount">
                                                            <strong>
                                                                <span class="font-xl fw-900 text-brand"
                                                                    id="order_total_price">
                                                                    &#8377;{{ number_format($total_amount, 2) }}
                                                                </span>
                                                            </strong>
                                                        </td>
                                                    @else
                                                        {{-- <li class="last" id="order_total_price">You
                                                            Pay<span>${{ number_format($total_amount, 2) }}</span></li> --}}
                                                        <td class="cart_total_label">Total</td>
                                                        <td class="cart_total_amount">
                                                            <strong>
                                                                <span class="font-xl fw-900 text-brand"
                                                                    id="order_total_price">
                                                                    &#8377;{{ number_format($total_amount, 2) }}
                                                                </span>
                                                            </strong>
                                                        </td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="{{ route('checkout') }}" class="btn "> <i
                                            class="fi-rs-box-alt mr-10"></i> Proceed To
                                        CheckOut</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', ".qty-up2", function() {
                let val = $(this).siblings('.qty-val2').text()
                val++
                $(this).siblings('.qty-val2').text(val)
                $(this).siblings('.main_count').val(val)
                if (val == 0) {
                    $(this).siblings('.qty-val2').text(1)
                    $(this).siblings('.main_count').val(1)
                }
            })

            $(document).on('click', ".qty-down2", function() {
                let val = $(this).siblings('.qty-val2').text()
                val--
                $(this).siblings('.qty-val2').text(val)
                $(this).siblings('.main_count').val(val)
                if (val == 0) {
                    $(this).siblings('.qty-val2').text(1)
                    $(this).siblings('.main_count').val(1)
                }
            })
        })
    </script>
@endpush
