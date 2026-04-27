@extends('frontend.layouts.master')
@section('title', 'Fulvari Nursery | Plants, Seeds & Garden Essentials')
{{-- {{ dd(Hash::make('admin@123')) }} --}}
@section('main-content')
@section('style')
    <style>
        .home-slider .single-hero-slider {
            height: 600px !important;
            /* Adjust height as needed */
            background-size: cover;
            background-position: center;
        }

        .home-slider .single-slider-img img {
            width: 100%;
            height: 600px;
            object-fit: cover;
        }

        .hero-slider-1 .single-hero-slider {
            padding: 0 !important;
        }

        .hero-slider-1 .single-slider-img {
            margin: 0 !important;
        }

        @media (max-width: 768px) {

            .home-slider .single-hero-slider,
            .home-slider .single-slider-img img {
                height: 300px !important;
            }
        }
    </style>
@endsection
{{-- <div class="modal fade custom-modal" id="onloadModal" tabindex="-1" aria-labelledby="onloadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="deal" style="background-image: url('frontend/images/menu-banner-7.png')">
                        <div class="deal-top">
                            <h2 class="text-brand">Deal of the Day</h2>
                            <h5>Limited quantities.</h5>
                        </div>
                        <div class="deal-content">
                            <h6 class="product-title"><a href="shop-product-right.html">Summer Collection New Morden
                                    Design</a></h6>
                            <div class="product-price"><span class="new-price">$139.00</span><span
                                    class="old-price">$160.99</span></div>
                        </div>
                        <div class="deal-bottom">
                            <p>Hurry Up! Offer End In:</p>
                            <div class="deals-countdown" data-countdown="2025/03/25 00:00:00"><span
                                    class="countdown-section"><span class="countdown-amount hover-up">03</span><span
                                        class="countdown-period"> days </span></span><span class="countdown-section"><span
                                        class="countdown-amount hover-up">02</span><span class="countdown-period"> hours
                                    </span></span><span class="countdown-section"><span
                                        class="countdown-amount hover-up">43</span><span class="countdown-period"> mins
                                    </span></span><span class="countdown-section"><span
                                        class="countdown-amount hover-up">29</span><span class="countdown-period"> sec
                                    </span></span></div>
                            <a href="shop-grid-right.html" class="btn hover-up">Shop Now <i
                                    class="fi-rs-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

<!-- Quick view -->
{{-- {{ dd($product_lists) }} --}}
@if ($product_lists)
    @foreach ($product_lists as $key => $product)
        <div class="modal fade custom-modal" id="quickViewModal{{ $product->id }}" tabindex="-1"
            aria-labelledby="quickViewModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-gallery">
                                    <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider">
                                        @php
                                            $photo = explode(',', $product->photo);
                                        @endphp
                                        @foreach ($photo as $data)
                                            <figure class="border-radius-10">
                                                <img src="{{ Storage::url($data) }}" alt="$data">
                                            </figure>
                                        @endforeach
                                    </div>
                                    <!-- THUMBNAILS -->
                                    <div class="slider-nav-thumbnails pl-15 pr-15">
                                        @php
                                            $photo = explode(',', $product->photo);
                                        @endphp
                                        @foreach ($photo as $data)
                                            <div><img src="{{ Storage::url($data) }}" alt="{{ $data }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info">
                                    <h3 class="title-detail mt-30">{{ $product->title }}</h3>
                                    <div class="product-detail-rating">
                                        {{-- <div class="pro-details-brand">
                                                <span> Brands:
                                                    <a
                                                        href="javascript:void(0)">{{ @ucwords($product->brand->title) }}</a></span>
                                            </div> --}}
                                        <div class="product-rate-cover text-end">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:90%">
                                                </div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> ({{ rand(50, 100) }}
                                                reviews)</span>
                                        </div>
                                    </div>
                                    <div class="clearfix product-price-cover">
                                        @php
                                            $after_discount =
                                                $product->price - ($product->price * $product->discount) / 100;
                                        @endphp
                                        <div class="product-price primary-color float-left">
                                            <ins><span
                                                    class="text-brand">&#8377;{{ number_format($after_discount, 2) }}</span></ins>
                                            <ins><span
                                                    class="old-price font-md ml-15">&#8377;{{ number_format($product->price, 2) }}</span></ins>
                                            <span class="save-price  font-md color3 ml-15">{{ $product->discount }}%
                                                Off</span>
                                        </div>
                                    </div>
                                    <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                    <div class="short-desc mb-30">
                                        <p class="font-sm">{!! html_entity_decode($product->summary) !!}</p>
                                    </div>
                                    <div class="attr-detail attr-size">
                                        <strong class="mr-10">Pot Size</strong>
                                        @if ($product->size)
                                            <ul class="list-filter size-filter font-small">
                                                @php
                                                    $sizes = explode(',', $product->size);
                                                @endphp
                                                @foreach ($sizes as $key => $size)
                                                    <li @if ($key == 0) class="active" @endif><a
                                                            href="javascript:void(0)">{{ $size }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                    <form action="{{ route('single-add-to-cart') }}" method="POST">
                                        @csrf
                                        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                        <div class="detail-extralink">
                                            <div class="detail-qty border radius">
                                                <a href="#" class="qty-down"><i
                                                        class="fi-rs-angle-small-down"></i></a>
                                                <span class="qty-val">1</span>
                                                <a href="#" class="qty-up"><i
                                                        class="fi-rs-angle-small-up"></i></a>
                                            </div>
                                            <input type="hidden" name="slug" value="{{ $product->slug }}">
                                            <input type="hidden" name="quant[1]" class="input-number" data-min="1"
                                                data-max="1000" value="1">

                                            <div class="product-extra-link2">
                                                <button type="submit" class="button button-add-to-cart">Add to
                                                    cart</button>
                                                <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                    href="{{ route('add-to-wishlist', $product->slug) }}"><i
                                                        class="fi-rs-heart"></i></a>
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
    @endforeach
@endif

<main class="main">
    <section class="home-slider position-relative">
        <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">
            @foreach ($banners as $key => $banner)
                <div class="single-hero-slider single-animation-wrap">
                    <div class="single-slider-img single-slider-img-1">
                        <img class="animated" src="{{ Storage::url($banner->photo) }}" alt="">
                    </div>
                </div>
            @endforeach
        </div>
        <div class="slider-arrow hero-slider-1-arrow"></div>
    </section>
    {{-- <section class="featured section-padding position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="frontend/images/feature-1.png" alt="">
                            <h4 class="bg-1">Free Shipping</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="frontend/images/feature-2.png" alt="">
                            <h4 class="bg-3">Online Order</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="frontend/images/feature-3.png" alt="">
                            <h4 class="bg-2">Save Money</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="frontend/images/feature-4.png" alt="">
                            <h4 class="bg-4">Promotions</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="frontend/images/feature-5.png" alt="">
                            <h4 class="bg-5">Happy Sell</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="frontend/images/feature-6.png" alt="">
                            <h4 class="bg-6">24/7 Support</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
    <section class="product-tabs section-padding position-relative wow fadeIn animated">
        <div class="bg-square"></div>
        <div class="container">
            <div class="tab-header">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                    </li>
                </ul>
                <a href="{{ route('product-grids') }}" class="view-more d-none d-md-flex">View More<i
                        class="fi-rs-angle-double-small-right"></i></a>
            </div>
            <!--End nav-tabs-->
            <div class="tab-content wow fadeIn animated" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                    <div class="row product-grid-4">
                        @php
                            $recentlyAddedProducts = DB::table('products')->where('status', 'active')->take(8)->get();
                        @endphp
                        @foreach ($recentlyAddedProducts as $key => $product)
                            <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ route('product-detail', $product->slug) }}">
                                                @php
                                                    $photos = explode(',', $product->photo);
                                                @endphp
                                                <img class="default-img" src="{{ Storage::url($photos[0]) }}"
                                                    alt="{{ $photos[0] }}">
                                                {{-- <img class="hover-img" src="{{ Storage::url($photos[1]) }}" alt=""> --}}
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn hover-up"
                                                data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal{{ $product->id }}"><i
                                                    class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                href="{{ route('add-to-wishlist', $product->slug) }}"><i
                                                    class="fi-rs-heart"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @if ($product->stock <= 0)
                                                <span class="out-of-stock">Sold Out</span>
                                            @elseif($product->condition == 'new')
                                                <span class="new">New</span>
                                            @elseif($product->condition == 'default')
                                                <span class="best">Best Sell</span>
                                            @elseif($product->condition == 'hot')
                                                <span class="hot">Hot</span>
                                            @else
                                                <span class="price-dec">{{ $product->discount }}% Off</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">Plants</a>
                                        </div>
                                        <h2><a
                                                href="{{ route('product-detail', $product->slug) }}">{{ $product->title }}</a>
                                        </h2>
                                        <div class="rating-result" title="{{ rand(75, 95) }}%">
                                            <span>
                                                <span> {{ rand(75, 95) }} %</span>
                                            </span>
                                        </div>
                                        @php
                                            $after_discount =
                                                $product->price - ($product->price * $product->discount) / 100;
                                        @endphp
                                        <div class="product-price">
                                            <span>&#8377;{{ number_format($after_discount, 2) }} </span>
                                            <span
                                                class="old-price">&#8377;{{ number_format($product->price, 2) }}</span>
                                        </div>
                                        <div class="product-action-1 show">
                                            <a aria-label="Add To Cart" class="action-btn hover-up"
                                                href="{{ route('add-to-cart', $product->slug) }}"><i
                                                    class="fi-rs-shopping-bag-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!--End tab-content-->
        </div>
    </section>
    <section class="banner-2 section-padding pb-0">
        <div class="container">
            <div class="banner-img banner-big wow fadeIn animated f-none">
                <img src="{{ asset('frontend/images/banner-4.png') }}" alt="">
                <div class="banner-text d-md-block d-none">
                    <h4 class="mb-15 mt-40 text-brand">Discover Your Perfect Plant</h4>
                    <h1 class="fw-600 mb-20">Bring nature home with <br> style, grace, and greenery.</h1>
                    <a href="{{ route('product-grids') }}" class="btn">View More <i
                            class="fi-rs-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>
    <section class="popular-categories section-padding mt-15 mb-25">
        <div class="container wow fadeIn animated">
            <h3 class="section-title mb-20"><span>Popular</span> Categories</h3>
            <div class="carausel-6-columns-cover position-relative">
                <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-arrows">
                </div>
                <div class="carausel-6-columns" id="carausel-6-columns">
                    @php
                        $categories = DB::table('categories')->where('status', 'active')->get();
                    @endphp
                    @foreach ($categories as $key => $category)
                        <div class="card-1">
                            <figure class=" img-hover-scale overflow-hidden">
                                <a href="{{ route('product-cat', $category->slug) }}"><img
                                        src="{{ Storage::url($category->photo) }}" alt=""></a>
                            </figure>
                            <h5><a href="{{ route('product-cat', $category->slug) }}">{{ $category->title }}</a></h5>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding mb-40">
        <div class="container wow fadeIn animated">
            <h3 class="section-title mb-20"><span>New</span> Arrivals</h3>
            <div class="carausel-6-columns-cover position-relative">
                <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-2-arrows">
                </div>
                <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-2">
                    @php
                        $recentlyAddedProducts = DB::table('products')
                            ->where('status', 'active')
                            ->orderBy('created_at', 'desc')
                            ->take(8)
                            ->inRandomOrder()
                            ->get();
                    @endphp
                    @foreach ($recentlyAddedProducts as $key => $product)
                        <div class="product-cart-wrap small hover-up">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        @php
                                            $photos = explode(',', $product->photo);
                                        @endphp
                                        <img class="default-img" src="{{ Storage::url($photos[0]) }}"
                                            alt="">
                                        {{-- <img class="hover-img" src="{{ Storage::url($photos[1]) }}" alt=""> --}}
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Quick view" class="action-btn small hover-up"
                                        data-bs-toggle="modal" data-bs-target="#quickViewModal{{ $product->id }}">
                                        <i class="fi-rs-eye"></i></a>
                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                        href="{{ route('add-to-wishlist', $product->slug) }}"" tabindex=" 0"><i
                                            class="fi-rs-heart"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @if ($product->stock <= 0)
                                        <span class="out-of-stock">Sold Out</span>
                                    @elseif($product->condition == 'new')
                                        <span class="new">New</span>
                                    @elseif($product->condition == 'default')
                                        <span class="best">Best Sell</span>
                                    @elseif($product->condition == 'hot')
                                        <span class="hot">Hot</span>
                                    @else
                                        <span class="price-dec">{{ $product->discount }}% Off</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <h2><a href="{{ route('product-detail', $product->slug) }}">{{ $product->title }}</a>
                                </h2>
                                <div class="rating-result" title="{{ rand(75, 95) }}%">
                                    <span>
                                    </span>
                                </div>
                                @php
                                    $after_discount = $product->price - ($product->price * $product->discount) / 100;
                                @endphp
                                <div class="product-price">
                                    <span>&#8377;{{ number_format($after_discount, 2) }} </span>
                                    <span class="old-price">&#8377;{{ number_format($product->price, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    {{-- <section class="deals section-padding mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 deal-co">
                        <div class="deal wow fadeIn animated mb-md-4 mb-sm-4 mb-lg-0"
                            style="background-image: url('frontend/images/menu-banner-7.jpg');">
                            <div class="deal-top">
                                <h2 class="text-brand">Deal of the Day</h2>
                                <h5>Limited quantities.</h5>
                            </div>
                            <div class="deal-content">
                                <h6 class="product-title"><a href="shop-product-right.html">Summer Collection New
                                        Morden Design</a></h6>
                                <div class="product-price"><span class="new-price">$139.00</span><span
                                        class="old-price">$160.99</span></div>
                            </div>
                            <div class="deal-bottom">
                                <p>Hurry Up! Offer End In:</p>
                                <div class="deals-countdown" data-countdown="2025/03/25 00:00:00"></div>
                                <a href="shop-grid-right.html" class="btn hover-up">Shop Now <i
                                        class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 deal-co">
                        <div class="deal wow fadeIn animated"
                            style="background-image: url('frontend/images/menu-banner-8.jpg');">
                            <div class="deal-top">
                                <h2 class="text-brand">Indoor Plants</h2>
                                <h5>Pots &amp; Planters</h5>
                            </div>
                            <div class="deal-content">
                                <h6 class="product-title"><a href="shop-product-right.html">Try something new on
                                        vacation</a></h6>
                                <div class="product-price"><span class="new-price">$178.00</span><span
                                        class="old-price">$256.99</span></div>
                            </div>
                            <div class="deal-bottom">
                                <p>Hurry Up! Offer End In:</p>
                                <div class="deals-countdown" data-countdown="2026/03/25 00:00:00"></div>
                                <a href="shop-grid-right.html" class="btn hover-up">Shop Now <i
                                        class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
    {{-- <section class="bg-grey-9 section-padding">
            <div class="container pt-25 pb-25">
                <div class="heading-tab d-flex">
                    <div class="heading-tab-left wow fadeIn animated">
                        <h3 class="section-title mb-20"><span>Monthly</span> Best Sell</h3>
                    </div>
                    <div class="heading-tab-right wow fadeIn animated">
                        <ul class="nav nav-tabs right no-border" id="myTab-1" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="nav-tab-one-1" data-bs-toggle="tab"
                                    data-bs-target="#tab-one-1" type="button" role="tab" aria-controls="tab-one"
                                    aria-selected="true">Featured</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="nav-tab-two-1" data-bs-toggle="tab"
                                    data-bs-target="#tab-two-1" type="button" role="tab" aria-controls="tab-two"
                                    aria-selected="false">Popular</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="nav-tab-three-1" data-bs-toggle="tab"
                                    data-bs-target="#tab-three-1" type="button" role="tab"
                                    aria-controls="tab-three" aria-selected="false">New added</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 d-none d-lg-flex">
                        <div class="banner-img style-2 wow fadeIn animated">
                            <img src="{{ asset('frontend/images/banner-9.jpg') }}" alt="">
                            <div class="banner-text">
                                <span>Plant Area</span>
                                <h4 class="mt-5">Save 17% on <br>Plants</h4>
                                <a href="shop-grid-right.html" class="text-white">Shop Now <i
                                        class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12">
                        <div class="tab-content wow fadeIn animated" id="myTabContent-1">
                            <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel"
                                aria-labelledby="tab-one-1">
                                <div class="carausel-4-columns-cover arrow-center position-relative">
                                    <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow"
                                        id="carausel-4-columns-arrows"></div>
                                    <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                                        <div class="product-cart-wrap">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="shop-product-right.html">
                                                        <img class="default-img" src="frontend/images/product-1-1.jpg"
                                                            alt="">
                                                        <img class="hover-img" src="frontend/images/product-1-2.jpg"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up"
                                                        data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                                        <i class="fi-rs-eye"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                                        href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up"
                                                        href="javascript:void(0)"><i class="fi-rs-shuffle"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">Hot</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a href="shop-grid-right.html">Nulla</a>
                                                </div>
                                                <h2><a href="shop-product-right.html">Maecenas eget</a></h2>
                                                <div class="rating-result" title="90%">
                                                    <span>
                                                        <span>70%</span>
                                                    </span>
                                                </div>
                                                <div class="product-price">
                                                    <span>$238.85 </span>
                                                    <span class="old-price">$245.8</span>
                                                </div>
                                                <div class="product-action-1 show">
                                                    <a aria-label="Add To Cart" class="action-btn hover-up"
                                                        href="shop-cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-cart-wrap">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="shop-product-right.html">
                                                        <img class="default-img" src="frontend/images/product-2-1.jpg"
                                                            alt="">
                                                        <img class="hover-img" src="frontend/images/product-2-2.jpg"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up"
                                                        data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                                        <i class="fi-rs-eye"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                                        href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up"
                                                        href="javascript:void(0)"><i class="fi-rs-shuffle"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="new">New</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a href="shop-grid-right.html">Duis </a>
                                                </div>
                                                <h2><a href="shop-product-right.html">Luctus suscipit</a></h2>
                                                <div class="rating-result" title="90%">
                                                    <span>
                                                        <span>70%</span>
                                                    </span>
                                                </div>
                                                <div class="product-price">
                                                    <span>$138.85 </span>
                                                    <span class="old-price">$145.8</span>
                                                </div>
                                                <div class="product-action-1 show">
                                                    <a aria-label="Add To Cart" class="action-btn hover-up"
                                                        href="shop-cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-cart-wrap">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="shop-product-right.html">
                                                        <img class="default-img" src="frontend/images/product-3-1.jpg"
                                                            alt="">
                                                        <img class="hover-img" src="frontend/images/product-3-2.jpg"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up"
                                                        data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                                        <i class="fi-rs-eye"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                                        href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up"
                                                        href="javascript:void(0)"><i class="fi-rs-shuffle"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="best">Best Sell</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a href="shop-grid-right.html">Fusce </a>
                                                </div>
                                                <h2><a href="shop-product-right.html">Aliquam ac</a></h2>
                                                <div class="rating-result" title="90%">
                                                    <span>
                                                        <span>70%</span>
                                                    </span>
                                                </div>
                                                <div class="product-price">
                                                    <span>$152.85 </span>
                                                    <span class="old-price">$156.8</span>
                                                </div>
                                                <div class="product-action-1 show">
                                                    <a aria-label="Add To Cart" class="action-btn hover-up"
                                                        href="shop-cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-cart-wrap">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="shop-product-right.html">
                                                        <img class="default-img" src="frontend/images/product-4-1.jpg"
                                                            alt="">
                                                        <img class="hover-img" src="frontend/images/product-4-2.jpg"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up"
                                                        data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                                        <i class="fi-rs-eye"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                                        href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up"
                                                        href="javascript:void(0)"><i class="fi-rs-shuffle"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">-12%</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a href="shop-grid-right.html">Nunc </a>
                                                </div>
                                                <h2><a href="shop-product-right.html">Fusce et ligula</a></h2>
                                                <div class="rating-result" title="90%">
                                                    <span>
                                                        <span>70%</span>
                                                    </span>
                                                </div>
                                                <div class="product-price">
                                                    <span>$238.85 </span>
                                                    <span class="old-price">$245.8</span>
                                                </div>
                                                <div class="product-action-1 show">
                                                    <a aria-label="Add To Cart" class="action-btn hover-up"
                                                        href="shop-cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-cart-wrap">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="shop-product-right.html">
                                                        <img class="default-img" src="frontend/images/product-11-1.jpg"
                                                            alt="">
                                                        <img class="hover-img" src="frontend/images/product-11-2.jpg"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up"
                                                        data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                                        <i class="fi-rs-eye"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                                        href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up"
                                                        href="javascript:void(0)"><i class="fi-rs-shuffle"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="sale">Sale</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a href="shop-grid-right.html">Aliquam</a>
                                                </div>
                                                <h2><a href="shop-product-right.html">Morbi lacinia</a></h2>
                                                <div class="rating-result" title="90%">
                                                    <span>
                                                        <span>70%</span>
                                                    </span>
                                                </div>
                                                <div class="product-price">
                                                    <span>$238.85 </span>
                                                    <span class="old-price">$245.8</span>
                                                </div>
                                                <div class="product-action-1 show">
                                                    <a aria-label="Add To Cart" class="action-btn hover-up"
                                                        href="shop-cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End tab-pane-->
                            <div class="tab-pane fade" id="tab-two-1" role="tabpanel" aria-labelledby="tab-two-1">
                                <div class="carausel-4-columns-cover arrow-center position-relative">
                                    <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow"
                                        id="carausel-4-columns-2-arrows"></div>
                                    <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns-2">
                                        <div class="product-cart-wrap">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="shop-product-right.html">
                                                        <img class="default-img" src="frontend/images/product-6-1.jpg"
                                                            alt="">
                                                        <img class="hover-img" src="frontend/images/product-6-2.jpg"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up"
                                                        data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                                        <i class="fi-rs-eye"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                                        href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up"
                                                        href="javascript:void(0)"><i class="fi-rs-shuffle"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">Hot</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a href="shop-grid-right.html">Watch</a>
                                                </div>
                                                <h2><a href="shop-product-right.html">Cotton Leaf Printed 2</a>
                                                </h2>
                                                <div class="rating-result" title="90%">
                                                    <span>
                                                        <span>70%</span>
                                                    </span>
                                                </div>
                                                <div class="product-price">
                                                    <span>$238.85 </span>
                                                    <span class="old-price">$245.8</span>
                                                </div>
                                                <div class="product-action-1 show">
                                                    <a aria-label="Add To Cart" class="action-btn hover-up"
                                                        href="shop-cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-cart-wrap">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="shop-product-right.html">
                                                        <img class="default-img" src="frontend/images/product-7-1.jpg"
                                                            alt="">
                                                        <img class="hover-img" src="frontend/images/product-7-2.jpg"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up"
                                                        data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                                        <i class="fi-rs-eye"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                                        href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up"
                                                        href="javascript:void(0)"><i class="fi-rs-shuffle"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="new">New</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a href="shop-grid-right.html">Watch</a>
                                                </div>
                                                <h2><a href="shop-product-right.html">Smart Speaker</a></h2>
                                                <div class="rating-result" title="90%">
                                                    <span>
                                                        <span>70%</span>
                                                    </span>
                                                </div>
                                                <div class="product-price">
                                                    <span>$138.85 </span>
                                                    <span class="old-price">$145.8</span>
                                                </div>
                                                <div class="product-action-1 show">
                                                    <a aria-label="Add To Cart" class="action-btn hover-up"
                                                        href="shop-cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-cart-wrap">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="shop-product-right.html">
                                                        <img class="default-img" src="frontend/images/product-5-1.jpg"
                                                            alt="">
                                                        <img class="hover-img" src="frontend/images/product-5-1.jpg"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up"
                                                        data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                                        <i class="fi-rs-eye"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                                        href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up"
                                                        href="javascript:void(0)"><i class="fi-rs-shuffle"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="best">Best Sell</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a href="shop-grid-right.html">Watch</a>
                                                </div>
                                                <h2><a href="shop-product-right.html">Hugy Speaker</a></h2>
                                                <div class="rating-result" title="90%">
                                                    <span>
                                                        <span>70%</span>
                                                    </span>
                                                </div>
                                                <div class="product-price">
                                                    <span>$152.85 </span>
                                                    <span class="old-price">$156.8</span>
                                                </div>
                                                <div class="product-action-1 show">
                                                    <a aria-label="Add To Cart" class="action-btn hover-up"
                                                        href="shop-cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-cart-wrap">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="shop-product-right.html">
                                                        <img class="default-img" src="frontend/images/product-10-1.jpg"
                                                            alt="">
                                                        <img class="hover-img" src="frontend/images/product-10-2.jpg"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up"
                                                        data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                                        <i class="fi-rs-eye"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                                        href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up"
                                                        href="javascript:void(0)"><i class="fi-rs-shuffle"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">-12%</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a href="shop-grid-right.html">Watch</a>
                                                </div>
                                                <h2><a href="shop-product-right.html">Smart Speaker</a></h2>
                                                <div class="rating-result" title="90%">
                                                    <span>
                                                        <span>70%</span>
                                                    </span>
                                                </div>
                                                <div class="product-price">
                                                    <span>$238.85 </span>
                                                    <span class="old-price">$245.8</span>
                                                </div>
                                                <div class="product-action-1 show">
                                                    <a aria-label="Add To Cart" class="action-btn hover-up"
                                                        href="shop-cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-cart-wrap">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="shop-product-right.html">
                                                        <img class="default-img" src="frontend/images/product-12-1.jpg"
                                                            alt="">
                                                        <img class="hover-img" src="frontend/images/product-12-2.jpg"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up"
                                                        data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                                        <i class="fi-rs-eye"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                                        href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up"
                                                        href="javascript:void(0)"><i class="fi-rs-shuffle"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="sale">Sale</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a href="shop-grid-right.html">Watch</a>
                                                </div>
                                                <h2><a href="shop-product-right.html">Cotton Leaf Printed</a></h2>
                                                <div class="rating-result" title="90%">
                                                    <span>
                                                        <span>70%</span>
                                                    </span>
                                                </div>
                                                <div class="product-price">
                                                    <span>$238.85 </span>
                                                    <span class="old-price">$245.8</span>
                                                </div>
                                                <div class="product-action-1 show">
                                                    <a aria-label="Add To Cart" class="action-btn hover-up"
                                                        href="shop-cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-three-1" role="tabpanel" aria-labelledby="tab-three-1">
                                <div class="carausel-4-columns-cover arrow-center position-relative">
                                    <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow"
                                        id="carausel-4-columns-3-arrows"></div>
                                    <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns-3">
                                        <div class="product-cart-wrap">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="shop-product-right.html">
                                                        <img class="default-img" src="frontend/images/product-8-1.jpg"
                                                            alt="">
                                                        <img class="hover-img" src="frontend/images/product-8-2.jpg"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up"
                                                        data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                                        <i class="fi-rs-eye"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                                        href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up"
                                                        href="javascript:void(0)"><i class="fi-rs-shuffle"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">Hot</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a href="shop-grid-right.html">Watch</a>
                                                </div>
                                                <h2><a href="shop-product-right.html">Cotton Leaf Printed</a></h2>
                                                <div class="rating-result" title="90%">
                                                    <span>
                                                        <span>70%</span>
                                                    </span>
                                                </div>
                                                <div class="product-price">
                                                    <span>$238.85 </span>
                                                    <span class="old-price">$245.8</span>
                                                </div>
                                                <div class="product-action-1 show">
                                                    <a aria-label="Add To Cart" class="action-btn hover-up"
                                                        href="shop-cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-cart-wrap">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="shop-product-right.html">
                                                        <img class="default-img" src="frontend/images/product-13-1.jpg"
                                                            alt="">
                                                        <img class="hover-img" src="frontend/images/product-13-2.jpg"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up"
                                                        data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                                        <i class="fi-rs-eye"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                                        href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up"
                                                        href="javascript:void(0)"><i class="fi-rs-shuffle"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="new">New</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a href="shop-grid-right.html">Watch</a>
                                                </div>
                                                <h2><a href="shop-product-right.html">Smart Speaker</a></h2>
                                                <div class="rating-result" title="90%">
                                                    <span>
                                                        <span>70%</span>
                                                    </span>
                                                </div>
                                                <div class="product-price">
                                                    <span>$138.85 </span>
                                                    <span class="old-price">$145.8</span>
                                                </div>
                                                <div class="product-action-1 show">
                                                    <a aria-label="Add To Cart" class="action-btn hover-up"
                                                        href="shop-cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-cart-wrap">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="shop-product-right.html">
                                                        <img class="default-img" src="frontend/images/product-14-1.jpg"
                                                            alt="">
                                                        <img class="hover-img" src="frontend/images/product-14-2.jpg"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up"
                                                        data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                                        <i class="fi-rs-eye"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                                        href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up"
                                                        href="javascript:void(0)"><i class="fi-rs-shuffle"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="best">Best Sell</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a href="shop-grid-right.html">Watch</a>
                                                </div>
                                                <h2><a href="shop-product-right.html">Hugy Speaker</a></h2>
                                                <div class="rating-result" title="90%">
                                                    <span>
                                                        <span>70%</span>
                                                    </span>
                                                </div>
                                                <div class="product-price">
                                                    <span>$152.85 </span>
                                                    <span class="old-price">$156.8</span>
                                                </div>
                                                <div class="product-action-1 show">
                                                    <a aria-label="Add To Cart" class="action-btn hover-up"
                                                        href="shop-cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-cart-wrap">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="shop-product-right.html">
                                                        <img class="default-img" src="frontend/images/product-15-1.jpg"
                                                            alt="">
                                                        <img class="hover-img" src="frontend/images/product-15-2.jpg"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up"
                                                        data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                                        <i class="fi-rs-eye"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                                        href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up"
                                                        href="javascript:void(0)"><i class="fi-rs-shuffle"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">-12%</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a href="shop-grid-right.html">Watch</a>
                                                </div>
                                                <h2><a href="shop-product-right.html">Smart Speaker</a></h2>
                                                <div class="rating-result" title="90%">
                                                    <span>
                                                        <span>70%</span>
                                                    </span>
                                                </div>
                                                <div class="product-price">
                                                    <span>$238.85 </span>
                                                    <span class="old-price">$245.8</span>
                                                </div>
                                                <div class="product-action-1 show">
                                                    <a aria-label="Add To Cart" class="action-btn hover-up"
                                                        href="shop-cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-cart-wrap">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="shop-product-right.html">
                                                        <img class="default-img" src="frontend/images/product-11-1.jpg"
                                                            alt="">
                                                        <img class="hover-img" src="frontend/images/product-11-2.jpg"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up"
                                                        data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                                        <i class="fi-rs-eye"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                                        href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up"
                                                        href="javascript:void(0)"><i class="fi-rs-shuffle"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="sale">Sale</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a href="shop-grid-right.html">Watch</a>
                                                </div>
                                                <h2><a href="shop-product-right.html">Cotton Leaf Printed</a></h2>
                                                <div class="rating-result" title="90%">
                                                    <span>
                                                        <span>70%</span>
                                                    </span>
                                                </div>
                                                <div class="product-price">
                                                    <span>$238.85 </span>
                                                    <span class="old-price">$245.8</span>
                                                </div>
                                                <div class="product-action-1 show">
                                                    <a aria-label="Add To Cart" class="action-btn hover-up"
                                                        href="shop-cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End tab-content-->
                    </div>
                    <!--End Col-lg-9-->
                </div>
            </div>
        </section> --}}
</main>
@endsection
@push('scripts')
<script>
    $(document).on('click', '.detail-qty a', function() {
        $(this).parent().parent().children('.input-number').val(parseInt($(this).siblings('.qty-val')
            .text()))
    })
</script>
@endpush
