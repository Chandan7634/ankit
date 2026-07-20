@extends('frontend.layouts.master')
@section('title', 'Fulvari Nursery | Plants, Seeds & Garden Essentials')
@section('main-content')
@section('style')
    <style>
        .home-slider .single-hero-slider {
            height: 600px !important;
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

        /* On phones a fixed height forces `cover` to crop the sides off wide
           banners, so give the box the banner ratio and fit the whole image. */
        @media (max-width: 768px) {

            .home-slider .single-hero-slider,
            .home-slider .single-slider-img img {
                height: auto !important;
            }

            .home-slider .single-slider-img img {
                aspect-ratio: 2 / 1;
                object-fit: contain;
                background: #fff;
            }
        }
    </style>
@endsection

{{-- Quick view modals --}}
@foreach ($product_lists as $product)
    @include('frontend.layouts._quickview', ['product' => $product])
@endforeach

<main class="main">
    <section class="home-slider position-relative">
        <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">
            @foreach ($banners as $banner)
                <div class="single-hero-slider single-animation-wrap">
                    <div class="single-slider-img single-slider-img-1">
                        <img class="animated" src="{{ Storage::url($banner->photo) }}" alt="{{ $banner->title }}">
                    </div>
                </div>
            @endforeach
        </div>
        <div class="slider-arrow hero-slider-1-arrow"></div>
    </section>

    <section class="product-tabs section-padding position-relative wow fadeIn animated">
        <div class="bg-square"></div>
        <div class="container">
            <div class="tab-header">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <h3 class="section-title mb-0"><span>Our</span> Plants</h3>
                    </li>
                </ul>
                <a href="{{ route('product-grids') }}" class="view-more d-none d-md-flex">View More<i
                        class="fi-rs-angle-double-small-right"></i></a>
            </div>
            <div class="tab-content wow fadeIn animated" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                    <div class="row product-grid-4">
                        @foreach ($product_lists as $product)
                            @php
                                $photos = array_filter(explode(',', (string) $product->photo));
                                $after_discount = $product->price - ($product->price * $product->discount) / 100;
                                $avg_rating = (float) $product->getReview->avg('rate');
                            @endphp
                            <div class="col-lg-3 col-md-4 col-4">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ route('product-detail', $product->slug) }}">
                                                <img class="default-img" src="{{ Storage::url($photos[0] ?? '') }}"
                                                    alt="{{ $product->title }}">
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
                                            @elseif($product->condition == 'hot')
                                                <span class="hot">Hot</span>
                                            @elseif($product->discount > 0)
                                                <span class="price-dec">{{ $product->discount }}% Off</span>
                                            @else
                                                <span class="best">Best Sell</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            @if ($product->cat_info)
                                                <a
                                                    href="{{ route('product-cat', $product->cat_info->slug) }}">{{ $product->cat_info->title }}</a>
                                            @else
                                                <a href="{{ route('product-grids') }}">Plants</a>
                                            @endif
                                        </div>
                                        <h2><a
                                                href="{{ route('product-detail', $product->slug) }}">{{ $product->title }}</a>
                                        </h2>
                                        @if ($avg_rating > 0)
                                            <div class="rating-result" title="{{ $avg_rating * 20 }}%">
                                                <span><span>{{ number_format($avg_rating * 20, 0) }}%</span></span>
                                            </div>
                                        @endif
                                        <div class="product-price">
                                            <span>&#8377;{{ number_format($after_discount, 2) }} </span>
                                            @if ($product->discount > 0)
                                                <span
                                                    class="old-price">&#8377;{{ number_format($product->price, 2) }}</span>
                                            @endif
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
        </div>
    </section>

    <section class="popular-categories section-padding mt-15 mb-25">
        <div class="container wow fadeIn animated">
            <h3 class="section-title mb-20"><span>Popular</span> Categories</h3>
            <div class="carausel-6-columns-cover position-relative">
                <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-arrows">
                </div>
                <div class="carausel-6-columns" id="carausel-6-columns">
                    @foreach ($category_lists as $category)
                        @php
                            $catImg = $category->icon ?: (explode(',', (string) $category->photo)[0] ?? null);
                        @endphp
                        <div class="card-1">
                            <figure class=" img-hover-scale overflow-hidden">
                                <a href="{{ route('product-cat', $category->slug) }}"><img
                                        src="{{ $catImg ? Storage::url($catImg) : asset('frontend/images/filvari-logo.jpeg') }}"
                                        alt="{{ $category->title }}"></a>
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
                    @foreach ($product_lists as $product)
                        @php
                            $photos = array_filter(explode(',', (string) $product->photo));
                            $after_discount = $product->price - ($product->price * $product->discount) / 100;
                            $avg_rating = (float) $product->getReview->avg('rate');
                        @endphp
                        <div class="product-cart-wrap small hover-up">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ route('product-detail', $product->slug) }}">
                                        <img class="default-img" src="{{ Storage::url($photos[0] ?? '') }}"
                                            alt="{{ $product->title }}">
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal"
                                        data-bs-target="#quickViewModal{{ $product->id }}">
                                        <i class="fi-rs-eye"></i></a>
                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                        href="{{ route('add-to-wishlist', $product->slug) }}" tabindex="0"><i
                                            class="fi-rs-heart"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @if ($product->stock <= 0)
                                        <span class="out-of-stock">Sold Out</span>
                                    @elseif($product->condition == 'new')
                                        <span class="new">New</span>
                                    @elseif($product->condition == 'hot')
                                        <span class="hot">Hot</span>
                                    @elseif($product->discount > 0)
                                        <span class="price-dec">{{ $product->discount }}% Off</span>
                                    @else
                                        <span class="best">Best Sell</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <h2><a href="{{ route('product-detail', $product->slug) }}">{{ $product->title }}</a>
                                </h2>
                                @if ($avg_rating > 0)
                                    <div class="rating-result" title="{{ $avg_rating * 20 }}%">
                                        <span><span>{{ number_format($avg_rating * 20, 0) }}%</span></span>
                                    </div>
                                @endif
                                <div class="product-price">
                                    <span>&#8377;{{ number_format($after_discount, 2) }} </span>
                                    @if ($product->discount > 0)
                                        <span class="old-price">&#8377;{{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
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
