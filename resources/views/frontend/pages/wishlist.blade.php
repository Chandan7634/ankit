@extends('frontend.layouts.master')
@section('title', 'Wishlist Page')
@section('main-content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> Wishlist
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table shopping-summery text-center">
                                <thead>
                                    <tr class="main-heading">
                                        <th scope="col" colspan="2">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Stock Status</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (App\Helpers\Helper::getAllProductFromWishlist())
                                        @foreach (App\Helpers\Helper::getAllProductFromWishlist() as $key => $wishlist)
                                            <tr>
                                                @php
                                                    $photo = explode(',', $wishlist->product['photo']);
                                                @endphp
                                                <td class="image product-thumbnail"><img src="{{ Storage::url($photo[0]) }}"
                                                        alt="{{ $photo[0] }}"></td>
                                                <td class="product-des product-name">
                                                    <h5 class="product-name">
                                                        <a href="{{ route('product-detail', $wishlist->product['slug']) }}">
                                                            {{ $wishlist->product['title'] }}
                                                        </a>
                                                    </h5>
                                                    <p class="font-xs">{!! $wishlist['summary'] !!}</p>
                                                </td>
                                                <td class="price" data-title="Price">
                                                    <span>&#8377;{{ number_format($wishlist['amount'], 2) }}</span>
                                                </td>
                                                <td class="text-center" data-title="Stock">
                                                    @if ($wishlist->product->stock > 0)
                                                        <span class="color3 font-weight-bold">In Stock</span>
                                                    @else
                                                        <span class="text-danger font-weight-bold">Out of stock</span>
                                                    @endif
                                                </td>
                                                <td class="text-right" data-title="Cart">
                                                    <a href="{{ route('add-to-cart', $wishlist->product['slug']) }}"
                                                        class="btn btn-sm">
                                                        <i class="fi-rs-shopping-bag mr-5"></i>
                                                        Add to cart
                                                    </a>
                                                </td>
                                                <td class="action" data-title="Remove">
                                                    <a href="{{ route('wishlist-delete', $wishlist->id) }}">
                                                        <i class="fi-rs-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                There are no any wishlist available. <a href="{{ route('product-grids') }}"
                                                    style="color:blue;">Continue shopping</a>

                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
@endpush
