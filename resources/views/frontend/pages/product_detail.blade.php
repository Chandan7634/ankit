@extends('frontend.layouts.master')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='copyright' content=''>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="online shop, purchase, cart, ecommerce site, best online shopping">
    <meta name="description" content="{{ $product_detail->summary }}">
    <meta property="og:url" content="{{ route('product-detail', $product_detail->slug) }}">
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $product_detail->title }}">
    <meta property="og:image" content="{{ $product_detail->photo }}">
    <meta property="og:description" content="{{ $product_detail->description }}">
@endsection

@section('styles')
    <style>
        /* From Uiverse.io by andrew-demchenk0 */
        .rating {
            position: absolute;
            top: -10px;
        }

        .rating:not(:checked)>input {
            display: none;
            appearance: none;
        }

        .rating:not(:checked)>label {
            float: right;
            cursor: pointer;
            font-size: 30px;
            color: #666;
        }

        .rating:not(:checked)>label:before {
            content: '★';
        }

        .rating>input:checked+label:hover,
        .rating>input:checked+label:hover~label,
        .rating>input:checked~label:hover,
        .rating>input:checked~label:hover~label,
        .rating>label:hover~input:checked~label {
            color: #e58e09;
        }

        .rating:not(:checked)>label:hover,
        .rating:not(:checked)>label:hover~label {
            color: #ff9e0b;
        }

        .rating>input:checked~label {
            color: #ffa723;
        }
    </style>
@endsection

@section('title', 'Fulvari || PRODUCT detail')
@section('main-content')
    @if ($product_detail->rel_prods)
        @foreach ($product_detail->rel_prods as $key => $product)
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
                                            <div class="product-rate-cover text-end">
                                                <div class="product-rate d-inline-block">
                                                    @php
                                                        $avg_rating = $product->getReview->avg('rate');
                                                    @endphp
                                                    <div class="product-rating" style="width:{{ $avg_rating * 20 }}%">
                                                    </div>
                                                </div>
                                                <span class="font-small ml-5 text-muted">
                                                    ({{ $product->getReview->count() }}
                                                    reviews)
                                                </span>
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
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> Shop Details
                    {{-- <span></span> Shop Details --}}
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-detail accordion-detail">
                            <div class="row mb-50">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-gallery">
                                        <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                        <!-- MAIN SLIDES -->
                                        <div class="product-image-slider">
                                            @php
                                                $photo = explode(',', $product_detail->photo);
                                            @endphp
                                            @foreach ($photo as $data)
                                                <figure class="border-radius-10">
                                                    <img src="{{ Storage::url($data) }}" alt="{{ $data }}">
                                                </figure>
                                            @endforeach
                                        </div>
                                        <div class="slider-nav-thumbnails pl-15 pr-15">
                                            @foreach ($photo as $data)
                                                <div><img src="{{ Storage::url($data) }}" alt="{{ $data }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-info">
                                        <h2 class="title-detail">{{ $product_detail->title }}</h2>
                                        <div class="product-detail-rating">
                                            @php
                                                $rate = ceil($product_detail->getReview->avg('rate'));
                                            @endphp
                                            <div class="product-rate-cover text-end">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width:{{ $rate * 20 }}%">
                                                    </div>
                                                </div>
                                                <span class="font-small ml-5 text-muted">
                                                    ({{ $product_detail->getReview->count() }}
                                                    reviews)</span>
                                            </div>
                                        </div>
                                        @php
                                            $after_discount =
                                                $product_detail->price -
                                                ($product_detail->price * $product_detail->discount) / 100;
                                        @endphp
                                        <div class="clearfix product-price-cover">
                                            <div class="product-price primary-color float-left">
                                                <ins>
                                                    <span
                                                        class="text-brand">&#8377;{{ number_format($after_discount, 2) }}</span>
                                                </ins>
                                                <ins><span
                                                        class="old-price font-md ml-15">&#8377;{{ number_format($product_detail->price, 2) }}</span></ins>
                                                <span
                                                    class="save-price  font-md color3 ml-15">{{ $product_detail->discount }}%
                                                    Off</span>
                                            </div>
                                        </div>
                                        <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                        <div class="short-desc mb-30">
                                            <p>{!! $product_detail->summary !!}</p>
                                        </div>
                                        {{-- <div class="product_sort_info font-xs mb-30">
                                            <ul>
                                                <li class="mb-10"><i class="fi-rs-crown mr-5"></i> 1 Year AL Jazeera
                                                    Brand Warranty</li>
                                                <li class="mb-10"><i class="fi-rs-refresh mr-5"></i> 30 Day Return Policy
                                                </li>
                                                <li><i class="fi-rs-credit-card mr-5"></i> Cash on Delivery available</li>
                                            </ul>
                                        </div> --}}
                                        {{-- <div class="attr-detail attr-color mb-15">
                                            <strong class="mr-10">Color</strong>
                                            <ul class="list-filter color-filter">
                                                <li><a href="#" data-color="Red"><span
                                                            class="product-color-red"></span></a></li>
                                                <li><a href="#" data-color="Yellow"><span
                                                            class="product-color-yellow"></span></a></li>
                                                <li class="active"><a href="#" data-color="White"><span
                                                            class="product-color-white"></span></a></li>
                                                <li><a href="#" data-color="Orange"><span
                                                            class="product-color-orange"></span></a></li>
                                                <li><a href="#" data-color="Cyan"><span
                                                            class="product-color-cyan"></span></a></li>
                                                <li><a href="#" data-color="Green"><span
                                                            class="product-color-green"></span></a></li>
                                                <li><a href="#" data-color="Purple"><span
                                                            class="product-color-purple"></span></a></li>
                                            </ul>
                                        </div> --}}
                                        <div class="attr-detail attr-size">
                                            <strong class="mr-10">Pot Size</strong>
                                            @php
                                                $sizes = explode(',', $product_detail->size);
                                            @endphp
                                            <ul class="list-filter size-filter font-small">
                                                @foreach ($sizes as $key => $size)
                                                    <li @if ($key == 0) class="active" @endif>
                                                        <a href="#"> {{ $size }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                        <form action="{{ route('single-add-to-cart') }}" method="POST">
                                            @csrf
                                            <div class="detail-extralink">
                                                <div class="detail-qty border radius">
                                                    <a href="#" class="qty-down"><i
                                                            class="fi-rs-angle-small-down"></i></a>
                                                    <span class="qty-val">1</span>
                                                    <a href="#" class="qty-up"><i
                                                            class="fi-rs-angle-small-up"></i></a>
                                                </div>
                                                <input type="hidden" name="slug"
                                                    value="{{ $product_detail->slug }}">
                                                <input type="hidden" name="quant[1]" class="input-number"
                                                    data-min="1" data-max="1000" value="1">

                                                <div class="product-extra-link2">
                                                    <button type="submit" class="button button-add-to-cart">Add to
                                                        cart</button>
                                                    <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                        href="{{ route('add-to-wishlist', $product_detail->slug) }}"><i
                                                            class="fi-rs-heart"></i></a>
                                                </div>
                                            </div>
                                        </form>
                                        <ul class="product-meta font-xs color-grey mt-50">
                                            {{-- <li class="mb-5">Category: <a
                                                    href="{{ route('product-cat', $product_detail->cat_info['slug']) }}">{{ $product_detail->cat_info['title'] }}</a>
                                            </li> --}}
                                            <li>
                                                {{-- @if ($product_detail->sub_cat_info)
                                                    <p class="cat mt-1">Sub Category :<a
                                                            href="{{ route('product-sub-cat', [$product_detail->cat_info['slug'], $product_detail->sub_cat_info['slug']]) }}">{{ $product_detail->sub_cat_info['title'] }}</a>
                                                    </p>
                                                @endif --}}
                                            </li>
                                            <li>Availability:<span
                                                    class="in-stock text-success ml-5">{{ $product_detail->stock }} Items
                                                    In
                                                    Stock</span></li>
                                        </ul>
                                    </div>
                                    <!-- Detail Info -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-10 m-auto entry-main-content">
                                    <h2 class="section-title style-1 mb-30">Description</h2>
                                    <div class="description mb-50">
                                        <p>{!! $product_detail->description !!}</p>
                                    </div>
                                    <h3 class="section-title style-1 mb-30 mt-30">Reviews
                                        ({{ ceil($product_detail->getReview->avg('rate')) }})</h3>
                                    <!--Comments-->
                                    <div class="comments-area style-2">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h4 class="mb-30">Customer reviews</h4>
                                                <div class="comment-list">
                                                    @foreach ($product_detail['getReview'] as $data)
                                                        <div class="single-comment justify-content-between d-flex">
                                                            <div class="user justify-content-between d-flex">
                                                                <div class="thumb text-center">
                                                                    @if ($data->user_info['photo'])
                                                                        <img src="{{ $data->user_info['photo'] }}"
                                                                            alt="{{ $data->user_info['photo'] }}">
                                                                    @else
                                                                        <img src="{{ asset('frontend/images/avatar.png') }}"
                                                                            alt="Profile.jpg">
                                                                    @endif
                                                                    <h6><a
                                                                            href="javascript:void(0)">{{ $data->user_info['name'] }}</a>
                                                                    </h6>
                                                                </div>
                                                                <div class="desc">
                                                                    <div class="product-rate d-inline-block">
                                                                        <div class="product-rating"
                                                                            style="width:{{ $data->rate * 20 }}%">
                                                                        </div>
                                                                    </div>
                                                                    <p>{{ $data->review }}
                                                                    </p>
                                                                    <div class="d-flex justify-content-between">
                                                                        <div class="d-flex align-items-center">
                                                                            <p class="font-xs mr-30">
                                                                                @php
                                                                                    $date = \Carbon\Carbon::parse(
                                                                                        $data->created_at,
                                                                                    );
                                                                                    $formattedDate = $date->format(
                                                                                        'F j, Y \a\t g:i a',
                                                                                    );
                                                                                @endphp
                                                                                {{ $formattedDate }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <h4 class="mb-30">Customer reviews</h4>
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        <div class="product-rating"
                                                            style="width:{{ $product_detail->getReview->avg('rate') * 20 }}%">
                                                        </div>
                                                    </div>
                                                    <h6>{{ number_format($product_detail->getReview->avg('rate'), 1) }} out
                                                        of 5</h6>
                                                </div>
                                                @php
                                                    $reviews = $product_detail->getReview;
                                                    $total_reviews = $reviews->count();
                                                @endphp
                                                @foreach ([5, 4, 3, 2, 1] as $star)
                                                    @php
                                                        $count = $reviews->where('rate', $star)->count();
                                                        $percent =
                                                            $total_reviews > 0 ? ($count / $total_reviews) * 100 : 0;
                                                    @endphp
                                                    <div class="progress">
                                                        <span>{{ $star }} star</span>
                                                        <div class="progress-bar" role="progressbar"
                                                            style="width: {{ $percent }}%;"
                                                            aria-valuenow="{{ $percent }}" aria-valuemin="0"
                                                            aria-valuemax="100">{{ round($percent) }}%
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <!--comment form-->
                                    <div class="comment-form">
                                        <h4 class="mb-25">Add a review</h4>
                                        @auth
                                            <div class="row">
                                                <div class="col-lg-8 col-md-12">
                                                    <form class="form-contact comment_form"
                                                        action="{{ route('review.store', $product_detail->slug) }}"
                                                        method="POST" id="commentForm">
                                                        @csrf
                                                        <div class="row position-relative">
                                                            <div class="col-12">
                                                                <div class="rating">
                                                                    <input value="5" name="rate" id="star5"
                                                                        type="radio">
                                                                    <label title="text" for="star5"></label>
                                                                    <input value="4" name="rate" id="star4"
                                                                        type="radio">
                                                                    <label title="text" for="star4"></label>
                                                                    <input value="3" name="rate" id="star3"
                                                                        type="radio">
                                                                    <label title="text" for="star3"></label>
                                                                    <input value="2" name="rate" id="star2"
                                                                        type="radio">
                                                                    <label title="text" for="star2"></label>
                                                                    <input value="1" name="rate" id="star1"
                                                                        type="radio">
                                                                    <label title="text" for="star1"></label>
                                                                </div>
                                                                {{-- <div class="star-rating__wrap">
                                                                    <input class="star-rating__input d-none"
                                                                        id="star-rating-5" type="radio" name="rate"
                                                                        value="5">
                                                                    <label class="star-rating__ico fa fa-star-o"
                                                                        for="star-rating-5" title="5 out of 5 stars"></label>
                                                                    <input class="star-rating__input d-none"
                                                                        id="star-rating-4" type="radio" name="rate"
                                                                        value="4">
                                                                    <label class="star-rating__ico fa fa-star-o"
                                                                        for="star-rating-4" title="4 out of 5 stars"></label>
                                                                    <input class="star-rating__input d-none"
                                                                        id="star-rating-3" type="radio" name="rate"
                                                                        value="3">
                                                                    <label class="star-rating__ico fa fa-star-o"
                                                                        for="star-rating-3" title="3 out of 5 stars"></label>
                                                                    <input class="star-rating__input d-none"
                                                                        id="star-rating-2" type="radio" name="rate"
                                                                        value="2">
                                                                    <label class="star-rating__ico fa fa-star-o"
                                                                        for="star-rating-2" title="2 out of 5 stars"></label>
                                                                    <input class="star-rating__input d-none"
                                                                        id="star-rating-1" type="radio" name="rate"
                                                                        value="1">
                                                                    <label class="star-rating__ico fa fa-star-o"
                                                                        for="star-rating-1" title="1 out of 5 stars"></label>
                                                                    @error('rate')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div> --}}
                                                            </div>
                                                            <div class="col-12 mt-25">
                                                                <div class="form-group">
                                                                    <textarea class="form-control w-100" name="review" id="comment" cols="30" rows="5"
                                                                        placeholder="Write Review"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="button button-contactForm">Submit
                                                                Review</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @else
                                            <p class="text-center p-5">
                                                You need to <a href="{{ route('login.form') }}"
                                                    style="color:rgb(54, 54, 204)">Login</a> OR <a style="color:blue"
                                                    href="{{ route('register.form') }}">Register</a>

                                            </p>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                            @if (count($product_detail->rel_prods) > 0)
                                <section class="section-padding mb-40">
                                    <div class="container wow fadeIn animated">
                                        <h3 class="section-title mb-20"><span>Related</span>Product</h3>
                                        <div class="carausel-6-columns-cover position-relative">
                                            <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow"
                                                id="carausel-6-columns-2-arrows">
                                            </div>
                                            <div class="carausel-6-columns carausel-arrow-center"
                                                id="carausel-6-columns-2">
                                                @foreach ($product_detail->rel_prods as $product)
                                                    @if ($product->id !== $product_detail->id)
                                                        <div class="product-cart-wrap small hover-up">
                                                            <div class="product-img-action-wrap">
                                                                <div class="product-img product-img-zoom">
                                                                    <a href="shop-product-right.html">
                                                                        @php
                                                                            $photos = explode(',', $product->photo);
                                                                        @endphp
                                                                        <img class="default-img"
                                                                            src="{{ Storage::url($photos[0]) }}"
                                                                            alt="">
                                                                        {{-- <img class="hover-img"
                                                                            src="{{ Storage::url($photos[1]) }}"
                                                                            alt=""> --}}
                                                                    </a>
                                                                </div>
                                                                <div class="product-action-1">
                                                                    <a aria-label="Quick view"
                                                                        class="action-btn small hover-up"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#quickViewModal{{ $product->id }}">
                                                                        <i class="fi-rs-eye"></i></a>
                                                                    <a aria-label="Add To Wishlist"
                                                                        class="action-btn small hover-up"
                                                                        href="{{ route('add-to-wishlist', $product->slug) }}""
                                                                        tabindex="0"><i class="fi-rs-heart"></i></a>
                                                                </div>
                                                                <div
                                                                    class="product-badges product-badges-position product-badges-mrg">
                                                                    @if ($product->stock <= 0)
                                                                        <span class="out-of-stock">Sold Out</span>
                                                                    @elseif($product->condition == 'new')
                                                                        <span class="new">New</span>
                                                                    @elseif($product->condition == 'default')
                                                                        <span class="best">Best Sell</span>
                                                                    @elseif($product->condition == 'hot')
                                                                        <span class="hot">Hot</span>
                                                                    @else
                                                                        <span class="price-dec">{{ $product->discount }}%
                                                                            Off</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="product-content-wrap">
                                                                <h2><a
                                                                        href="{{ route('product-detail', $product->slug) }}">{{ $product->title }}</a>
                                                                </h2>
                                                                @php
                                                                    $avg_rating = $product->getReview->avg('rate');
                                                                @endphp
                                                                <div class="rating-result"
                                                                    title="{{ $avg_rating * 20 }}%">
                                                                    <span>
                                                                        <span>{{ number_format($avg_rating * 20, 0) }}%</span>
                                                                    </span>
                                                                </div>
                                                                @php
                                                                    $after_discount =
                                                                        $product->price -
                                                                        ($product->price * $product->discount) / 100;
                                                                @endphp
                                                                <div class="product-price">
                                                                    <span>&#8377;{{ number_format($after_discount, 2) }}
                                                                    </span>
                                                                    <span
                                                                        class="old-price">&#8377;{{ number_format($product->price, 2) }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> --}}

    {{-- <script>
        $('.cart').click(function(){
            var quantity=$('#quantity').val();
            var pro_id=$(this).data('id');
            // alert(quantity);
            $.ajax({
                url:"{{route('add-to-cart')}}",
                type:"POST",
                data:{
                    _token:"{{csrf_token()}}",
                    quantity:quantity,
                    pro_id:pro_id
                },
                success:function(response){
                    console.log(response);
					if(typeof(response)!='object'){
						response=$.parseJSON(response);
					}
					if(response.status){
						swal('success',response.msg,'success').then(function(){
							document.location.href=document.location.href;
						});
					}
					else{
                        swal('error',response.msg,'error').then(function(){
							document.location.href=document.location.href;
						});
                    }
                }
            })
        });
    </script> --}}
@endpush
