<header class="header-area header-style-1 header-height-2">
    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info">
                        <ul>
                            <li><i class="fi-rs-smartphone"></i> <a href="tel:7667459049">(+91) 7667459049</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4">
                    <div class="text-center">
                        <div id="news-flash" class="d-inline-block">
                            <ul>
                                <li>Get great devices up to 50% off <a href="{{ route('product-grids') }}">View
                                        details</a>
                                </li>
                                <li>Supper Value Deals - Save more with coupons</li>
                                <li>Fresh Indoor Plants, save up 35% off today <a
                                        href="{{ route('product-grids') }}">Shop
                                        now</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>
                            @auth
                                @if (Auth::user()->role == 'admin')
                                    <li><i class="fi-rs-user"></i> <a href="{{ route('admin') }}">Dashboard</a></li>
                                @else
                                    <li><i class="fi-rs-user"></i> <a href="{{ route('user') }}">My Account</a></li>
                                @endif
                                <li><i class="fi-rs-sign-out"></i> <a href="{{ route('user.logout') }}">Logout</a></li>
                            @else
                                <li><i class="fi-rs-user"></i><a href="{{ route('login.form') }}">Login /</a>
                                    <a href="{{ route('register.form') }}">Register</a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="{{ route('home') }}"><img src="{{ asset('frontend/images/filvari-logo.jpeg') }}" alt="logo"></a>
                </div>
                <div class="header-right">
                    <div class="search-style-2">
                        <form method="POST" action="{{ route('product.search') }}">
                            @csrf
                            <select class="select-active">
                                <option>All Categories</option>
                                @foreach (App\Helpers\Helper::getAllCategory() as $cat)
                                    <option>{{ $cat->title }}</option>
                                @endforeach
                            </select>
                            <input name="search" placeholder="Search Products Here....." type="search">
                            {{-- <button class="btnn" type="submit"><i class="ti-search"></i></button> --}}
                        </form>
                    </div>
                    <div class="header-action-right">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a href="{{ route('wishlist') }}" class="me-1">
                                    <img class="svgInject" alt="icon"
                                        src="{{ asset('frontend/images/icon-heart.svg') }}">
                                    <span class="pro-count blue">
                                        {{ App\Helpers\Helper::wishlistCount() }}
                                    </span>
                                </a>
                                @auth
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                        <ul>
                                            @foreach (App\Helpers\Helper::getAllProductFromWishlist() as $data)
                                                @php
                                                    $photo = explode(',', $data->product['photo']);
                                                @endphp
                                                <li>
                                                    <div class="shopping-cart-img">
                                                        <a href="javascript:void(0)">
                                                            <img alt="Fulvari" src="{{ Storage::url($photo[0]) }}"
                                                                alt="{{ $photo[0] }}"></a>
                                                    </div>
                                                    <div class="shopping-cart-title">
                                                        <h4>
                                                            <a target="_blank"
                                                                href="{{ route('product-detail', $data->product['slug']) }}">
                                                                {{ $data->product['title'] }}
                                                            </a>
                                                        </h4>
                                                        <h4><span class="quantity"> {{ $data->quantity }} × </span>
                                                            <span class="amount">
                                                                &#8377;{{ number_format($data->price, 2) }}</span>
                                                        </h4>
                                                    </div>
                                                    <div class="shopping-cart-delete remove">
                                                        <a href="{{ route('wishlist-delete', $data->id) }}"><i
                                                                class="fi-rs-cross-small"></i></a>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="shopping-cart-footer">
                                            <div class="shopping-cart-total">
                                                <h4>
                                                    Total
                                                    <span class="total-amount">
                                                        &#8377;
                                                        {{ number_format(App\Helpers\Helper::totalWishlistPrice(), 2) }}
                                                    </span>
                                                </h4>
                                            </div>
                                            <div class="shopping-cart-button">
                                                {{-- <a href="{{ route('cart') }}" style="visibility: none;"></a> --}}
                                                <a href="{{ route('cart') }}">Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                @endauth
                            </div>
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{ route('cart') }}">
                                    <img alt="Fulvari" src="{{ asset('frontend/images/icon-cart.svg') }}">
                                    <span class="pro-count blue">
                                        {{ App\Helpers\Helper::cartCount() }}
                                    </span>
                                </a>
                                @auth
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                        <ul>
                                            @foreach (App\Helpers\Helper::getAllProductFromCart() as $data)
                                                @php
                                                    $photo = explode(',', $data->product['photo']);
                                                @endphp
                                                <li>
                                                    <div class="shopping-cart-img">
                                                        <a href="javascript:void(0)"><img
                                                                alt="{{ Storage::url($photo[0]) }}"
                                                                src="{{ Storage::url($photo[0]) }}"></a>
                                                    </div>
                                                    <div class="shopping-cart-title">
                                                        <h4>
                                                            <a
                                                                href="{{ route('product-detail', $data->product['slug']) }}">{{ $data->product['title'] }}
                                                            </a>
                                                        </h4>
                                                        <h4><span class="quantity">{{ $data->quantity }} × </span>
                                                            <span
                                                                class="amount">&#8377;{{ number_format($data->price, 2) }}
                                                            </span>
                                                        </h4>
                                                    </div>
                                                    <div class="shopping-cart-delete remove">
                                                        <a href="{{ route('cart-delete', $data->id) }}"><i
                                                                class="fi-rs-cross-small"></i></a>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="shopping-cart-footer">
                                            <div class="shopping-cart-total">
                                                <h4>Total
                                                    <span>&#8377;{{ number_format(App\Helpers\Helper::totalCartPrice(), 2) }}</span>
                                                </h4>
                                            </div>
                                            <div class="shopping-cart-button">
                                                <a href="{{ route('checkout') }}">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="{{ route('home') }}"><img src="{{ asset('frontend/images/filvari-logo.jpeg') }}" alt="logo"></a>
                </div>
                <div class="header-nav d-none d-lg-flex">
                    <nav class="cat-icon-menu">
                        @foreach (App\Helpers\Helper::getAllCategory() as $cat)
                            @php
                                $catImg = $cat->icon ?: (explode(',', (string) $cat->photo)[0] ?? null);
                            @endphp
                            <a href="{{ route('product-cat', $cat->slug) }}"
                                class="cat-icon-item {{ request()->is('product-cat/' . $cat->slug) ? 'active' : '' }}">
                                <span class="cat-icon-circle">
                                    @if ($catImg)
                                        <img src="{{ Storage::url($catImg) }}" alt="{{ $cat->title }}"
                                            loading="lazy">
                                    @else
                                        <i class="fi-rs-plant"></i>
                                    @endif
                                </span>
                                <span class="cat-icon-name">{{ $cat->title }}</span>
                            </a>
                        @endforeach
                    </nav>
                </div>

                <p class="mobile-promotion">Welcome to <span class="text-brand">Fulvari</span>. Big Sale Up to 40%
                </p>
                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">
                        <div class="header-action-icon-2">
                            <a href="{{ route('wishlist') }}">
                                <img alt="Fulvari" src="{{ asset('frontend/images/icon-heart.svg') }}">
                                <span class="pro-count white">
                                    {{ App\Helpers\Helper::wishlistCount() }}
                                </span>
                            </a>
                        </div>
                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="{{ route('cart') }}">
                                <img alt="Fulvari" src="{{ asset('frontend/images/icon-cart.svg') }}">
                                <span class="pro-count white">{{ App\Helpers\Helper::cartCount() }}</span>
                            </a>
                            @auth
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        @foreach (App\Helpers\Helper::getAllProductFromCart() as $data)
                                            @php
                                                $photo = explode(',', $data->product['photo']);
                                            @endphp
                                            <li>
                                                <div class="shopping-cart-img">
                                                    <a href="javascript:void(0)"><img alt="{{ Storage::url($photo[0]) }}"
                                                            src="{{ Storage::url($photo[0]) }}"></a>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h4>
                                                        <a href="{{ route('product-detail', $data->product['slug']) }}">{{ $data->product['title'] }}
                                                        </a>
                                                    </h4>
                                                    <h4><span class="quantity">{{ $data->quantity }} × </span>
                                                        <span class="amount">&#8377;{{ number_format($data->price, 2) }}
                                                        </span>
                                                    </h4>
                                                </div>
                                                <div class="shopping-cart-delete remove">
                                                    <a href="{{ route('cart-delete', $data->id) }}"><i
                                                            class="fi-rs-cross-small"></i></a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total
                                                <span>&#8377;{{ number_format(App\Helpers\Helper::totalCartPrice(), 2) }}</span>
                                            </h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="{{ route('checkout') }}">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            @endauth
                        </div>
                        <div class="header-action-icon-2 d-block d-lg-none">
                            <div class="burger-icon">
                                <span class="burger-icon-top"></span>
                                <span class="burger-icon-mid"></span>
                                <span class="burger-icon-bottom"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="mobile-cat-strip d-block d-lg-none" aria-label="Shop by category">
        @foreach (App\Helpers\Helper::getAllCategory() as $cat)
            @php
                $catImg = $cat->icon ?: (explode(',', (string) $cat->photo)[0] ?? null);
            @endphp
            <a href="{{ route('product-cat', $cat->slug) }}"
                class="mobile-cat-strip-item {{ request()->is('product-cat/' . $cat->slug) ? 'active' : '' }}">
                <span class="cat-icon-circle">
                    @if ($catImg)
                        <img src="{{ Storage::url($catImg) }}" alt="{{ $cat->title }}" loading="lazy">
                    @else
                        <i class="fi-rs-plant"></i>
                    @endif
                </span>
                <span class="cat-icon-name">{{ $cat->title }}</span>
            </a>
        @endforeach
    </nav>
</header>
<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="{{ route('home') }}"><img src="{{ asset('frontend/images/filvari-logo.jpeg') }}" alt="logo"></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form method="POST" action="{{ route('product.search') }}">
                    @csrf
                    <select class="select-active">
                        <option>All Categories</option>
                        @foreach (App\Helpers\Helper::getAllCategory() as $cat)
                            <option>{{ $cat->title }}</option>
                        @endforeach
                    </select>
                    <input name="search" placeholder="Search Products Here....." type="search">
                    {{-- <button class="btnn" type="submit"><i class="ti-search"></i></button> --}}
                </form>
            </div>
            <div class="mobile-cat-menu mobile-header-border">
                <h6 class="mb-15 mt-20">Shop by Category</h6>
                @foreach (App\Helpers\Helper::getAllCategory() as $cat)
                    @php
                        $catImg = $cat->icon ?: (explode(',', (string) $cat->photo)[0] ?? null);
                    @endphp
                    <a href="{{ route('product-cat', $cat->slug) }}" class="mobile-cat-item">
                        <span class="cat-icon-circle cat-icon-circle-sm">
                            @if ($catImg)
                                <img src="{{ Storage::url($catImg) }}" alt="{{ $cat->title }}" loading="lazy">
                            @else
                                <i class="fi-rs-plant"></i>
                            @endif
                        </span>
                        <span>{{ $cat->title }}</span>
                    </a>
                @endforeach
            </div>
            <div class="mobile-header-info-wrap mobile-header-border">
                <div class="single-mobile-header-info mt-30">
                    <a href="{{ route('order.track') }}"><i class="fa fa-truck"></i> Track Order</a>
                </div>
                @auth
                    @if (Auth::user()->role == 'admin')
                        <div class="single-mobile-header-info">
                            <a href="{{ route('admin') }}"><i class="ti-user"></i> Dashboard</a>
                        </div>
                    @else
                        <div class="single-mobile-header-info">
                            <a href="{{ route('user') }}"><i class="ti-user"></i> My Account</a>
                        </div>
                    @endif
                    <div class="single-mobile-header-info">
                        <a href="{{ route('user.logout') }}"><i class="feather feather-power"></i> Logout</a>
                    </div>
                @else
                    <div class="single-mobile-header-info">
                        <a href="{{ route('login.form') }}">Log In / </a> <a href="{{ route('register.form') }}"> Sign
                            Up
                        </a>
                    </div>
                @endauth
                <div class="single-mobile-header-info">
                    <a href="tel:7667459049">(+91) 7667459049 </a>
                </div>
            </div>
            <div class="mobile-social-icon">
                <h5 class="mb-15 text-grey-4">Follow Us</h5>
                <a href="#"><img src="{{ asset('frontend/images/icon-facebook.svg') }}" alt=""></a>
                <a href="#"><img src="{{ asset('frontend/images/icon-twitter.svg') }}" alt=""></a>
                <a href="#"><img src="{{ asset('frontend/images/icon-instagram.svg') }}" alt=""></a>
                <a href="#"><img src="{{ asset('frontend/images/icon-pinterest.svg') }}" alt=""></a>
                <a href="#"><img src="{{ asset('frontend/images/icon-youtube.svg') }}" alt=""></a>
            </div>
        </div>
    </div>
</div>
