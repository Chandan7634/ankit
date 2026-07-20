@extends('frontend.layouts.master')

@section('title', 'Fulvari || Shop List')

@section('main-content')
    @if ($products)
        @foreach ($products as $key => $product)
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
    <main class="main" style="transform: none;">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow">Home</a>
                    <span></span> Shop
                </div>
            </div>
        </div>
        <form action="{{ route('shop.filter') }}" method="POST">
            @csrf
            <section class="mt-50 mb-50" style="transform: none;">
                <div class="container" style="transform: none;">
                    <div class="row flex-row-reverse" style="transform: none;">
                        <div class="col-lg-9">
                            <div class="shop-product-fillter">
                                <div class="totall-product">
                                    <p> We found <strong class="text-brand">{{ $products->total() }}</strong> items for
                                        you!</p>
                                </div>
                                <div class="sort-by-product-area">
                                    <div class="sort-by-cover mr-10">
                                        <div class="sort-by-product-wrap">
                                            <div class="sort-by">
                                                <span><i class="fi-rs-apps"></i>Show:</span>
                                            </div>
                                            <div class="sort-by-dropdown-wrap">
                                                <span> {{ Request::get('show') ?: 50 }} <i
                                                        class="fi-rs-angle-small-down"></i></span>
                                            </div>
                                        </div>
                                        <div class="sort-by-dropdown">
                                            <ul>
                                                <li><a
                                                        href="{{ Request::fullUrlWithQuery(['show' => 50, 'page' => 1]) }}">50</a>
                                                </li>
                                                <li><a
                                                        href="{{ Request::fullUrlWithQuery(['show' => 100, 'page' => 1]) }}">100</a>
                                                </li>
                                                <li><a
                                                        href="{{ Request::fullUrlWithQuery(['show' => 150, 'page' => 1]) }}">150</a>
                                                </li>
                                                <li><a
                                                        href="{{ Request::fullUrlWithQuery(['show' => 200, 'page' => 1]) }}">200</a>
                                                </li>
                                                <li><a
                                                        href="{{ Request::fullUrlWithQuery(['show' => '', 'page' => 1]) }}">All</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="sort-by-cover">
                                        <div class="sort-by-product-wrap">
                                            <div class="sort-by">
                                                <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                            </div>
                                            <div class="sort-by-dropdown-wrap">
                                                <span>
                                                    {{ Request::get('sortBy') ? ucfirst(str_replace('_', ' ', Request::get('sortBy'))) : 'Featured' }}
                                                    <i class="fi-rs-angle-small-down"></i></span>
                                            </div>
                                        </div>
                                        <div class="sort-by-dropdown">
                                            <ul>
                                                <li><a
                                                        href="{{ Request::fullUrlWithQuery(['sortBy' => '', 'page' => 1]) }}">Featured</a>
                                                </li>
                                                <li><a
                                                        href="{{ Request::fullUrlWithQuery(['sortBy' => 'price', 'page' => 1]) }}">Price:
                                                        Low to High</a></li>
                                                <li><a
                                                        href="{{ Request::fullUrlWithQuery(['sortBy' => 'title', 'page' => 1]) }}">Title</a>
                                                </li>
                                                <li><a
                                                        href="{{ Request::fullUrlWithQuery(['sortBy' => 'new', 'page' => 1]) }}">Release
                                                        Date</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row product-grid-3">
                                @if (count($products))
                                    @foreach ($products as $key => $product)
                                        <div class="col-lg-4 col-md-4 col-4">
                                            <div class="product-cart-wrap mb-30">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img product-img-zoom">
                                                        <a href="{{ route('product-detail', $product->slug) }}">
                                                            @php
                                                                $photos = explode(',', $product->photo);
                                                            @endphp
                                                            <img class="default-img" src="{{ Storage::url($photos[0]) }}"
                                                                alt="{{ $photos[0] }}">
                                                            {{-- <img class="hover-img" src="{{ Storage::url($photos[1]) }}"
                                                                alt=""> --}}
                                                        </a>
                                                    </div>
                                                    <div class="product-action-1">
                                                        <a aria-label="Quick view" class="action-btn small hover-up"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#quickViewModal{{ $product->id }}">
                                                            <i class="fi-rs-eye"></i></a>
                                                        <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                                            href="{{ route('add-to-wishlist', $product->slug) }}"
                                                            tabindex="0"><i class="fi-rs-heart"></i></a>
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
                                                            <span class="price-dec">{{ $product->discount }}%
                                                                Off</span>
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
                                                            $product->price -
                                                            ($product->price * $product->discount) / 100;
                                                    @endphp
                                                    <div class="product-price">
                                                        <span>&#8377;{{ number_format($after_discount, 2) }}
                                                        </span>
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
                                @else
                                    <h4 class="text-danger" style="margin:100px auto;">Sorry, there are no products
                                        according
                                        to the range given. Try selecting different one to see more results.</h4>
                                @endif
                            </div>
                            <!--pagination-->
                            <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                                {{-- {{ $products->appends($_GET)->links() }} --}}
                                {{-- <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-start">
                                        <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                        <li class="page-item"><a class="page-link" href="#">02</a></li>
                                        <li class="page-item"><a class="page-link" href="#">03</a></li>
                                        <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                        <li class="page-item"><a class="page-link" href="#">16</a></li>
                                        <li class="page-item"><a class="page-link" href="#"><i
                                                    class="fi-rs-angle-double-small-right"></i></a></li>
                                    </ul>
                                </nav> --}}
                            </div>
                        </div>
                        <div class="col-lg-3 primary-sidebar sticky-sidebar"
                            style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                            <div class="theiaStickySidebar"
                                style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; top: 0px; left: 111.6px;">
                                <div class="widget-category mb-30">
                                    <h5 class="section-title style-1 mb-30 wow fadeIn animated animated animated"
                                        style="visibility: visible;">Category</h5>
                                    @php
                                        $menu = App\Models\Category::getAllParentWithChild();
                                    @endphp
                                    @if ($menu)
                                        <ul class="categories">
                                            @foreach ($menu as $cat_info)
                                                @if ($cat_info->child_cat->count() > 0)
                                                    <li>
                                                        <a
                                                            href="{{ route('product-cat', $cat_info->slug) }}">{{ $cat_info->title }}</a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a
                                                            href="{{ route('product-cat', $cat_info->slug) }}">{{ $cat_info->title }}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        @else
                                            <li><a
                                                    href="{{ route('product-cat', $cat_info->slug) }}">{{ $cat_info->title }}</a>
                                            </li>
                                    @endif

                                    </ul>
                                </div>
                                <div class="sidebar-widget price_range range mb-30">
                                    <div class="widget-header position-relative mb-20 pb-10">
                                        <h5 class="widget-title mb-10">Fill by price</h5>
                                        <div class="bt-1 border-color-1"></div>
                                    </div>

                                    <div class="price-filter">
                                        <div class="price-filter-inner">
                                            @php
                                                $max = DB::table('products')->max('price');
                                            @endphp
                                            <div id="slider-range"
                                                class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                                data-min="0" data-max="{{ $max }}"></div>
                                            <div class="product_filter">
                                                <div class="label-input">
                                                    <span>Range:</span>
                                                    <input style="" type="text" id="amount" readonly />
                                                    <input type="hidden" name="price_range" id="price_range"
                                                        value="@if (!empty($_GET['price'])) {{ $_GET['price'] }} @endif" />
                                                </div>
                                                <button type="submit" class=" btn btn-sm btn-default filter_button"> <i
                                                        class="fi-rs-filter mr-5"></i>Filter</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10">
                                    <div class="widget-header position-relative mb-20 pb-10">
                                        <h5 class="widget-title mb-10">New products</h5>
                                        <div class="bt-1 border-color-1"></div>
                                    </div>
                                    @foreach ($recent_products as $product)
                                        @php
                                            $photo = explode(',', $product->photo);
                                        @endphp
                                        <div class="single-post clearfix">
                                            <div class="image">
                                                <img src="{{ Storage::url($photo[0]) }}" alt="{{ $photo[0] }}">
                                            </div>
                                            @php
                                                $org = $product->price - ($product->price * $product->discount) / 100;
                                            @endphp
                                            <div class="content pt-10">
                                                <h5><a href="{{ route('product-detail', $product->slug) }}">
                                                        {{ $product->title }}</a></h5>
                                                <p class="price mb-0 mt-5">&#8377;{{ number_format($org, 2) }}
                                                </p>
                                                <div class="product-rate">
                                                    <div class="product-rating" style="width:90%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                {{-- <div class="widget-category mb-30">
                                    <h5 class="section-title style-1 mb-30 wow fadeIn animated animated animated"
                                        style="visibility: visible;">Brands</h5>
                                    @php
                                        $brands = DB::table('brands')
                                            ->orderBy('title', 'ASC')
                                            ->where('status', 'active')
                                            ->get();
                                    @endphp
                                    @if ($brands)
                                        <ul class="categories">
                                            @foreach ($brands as $brand)
                                                <li>
                                                    <a
                                                        href="{{ route('product-brand', $brand->slug) }}">{{ $brand->title }}</a>
                                                </li>
                                            @endforeach
                                    @endif
                                    </ul>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </main>

@endsection

@push('scripts')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> --}}
    {{-- <script>
        $('.cart').click(function(){
            var quantity=1;
            var pro_id=$(this).data('id');
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
							// document.location.href=document.location.href;
						});
                    }
                }
            })
        });
    </script> --}}
    {{-- <script>
        $(document).ready(function() {
            /*----------------------------------------------------*/
            /*  Jquery Ui slider js
            /*----------------------------------------------------*/
            if ($("#slider-range").length > 0) {
                const max_value = parseInt($("#slider-range").data('max')) || 500;
                const min_value = parseInt($("#slider-range").data('min')) || 0;
                const currency = $("#slider-range").data('currency') || '';
                let price_range = min_value + '-' + max_value;
                if ($("#price_range").length > 0 && $("#price_range").val()) {
                    price_range = $("#price_range").val().trim();
                }

                let price = price_range.split('-');
                $("#slider-range").slider({
                    range: true,
                    min: min_value,
                    max: max_value,
                    values: price,
                    slide: function(event, ui) {
                        $("#amount").val(currency + ui.values[0] + " -  " + currency + ui.values[1]);
                        $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
                    }
                });
            }
            if ($("#amount").length > 0) {
                const m_currency = $("#slider-range").data('currency') || '';
                $("#amount").val(m_currency + $("#slider-range").slider("values", 0) +
                    "  -  " + m_currency + $("#slider-range").slider("values", 1));
            }
        })
    </script> --}}
@endpush
