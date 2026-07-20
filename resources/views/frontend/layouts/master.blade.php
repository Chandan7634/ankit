<!DOCTYPE html>
<html lang="zxx">
@yield('meta')
<!-- Title Tag  -->
<title>@yield('title')</title>


<head>
    @include('frontend.layouts.head')
    <style>
        @media (min-width:976px) {
            .header-wrap .header-nav {
                width: 100%;
                justify-content: center !important;
            }
        }

        .short-desc p {
            display: -webkit-box !important;
            -webkit-line-clamp: 4 !important;
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
        }

        /* ── Category icon menu (header) ─────────────────────────────── */
        .cat-icon-menu {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            gap: 28px;
            padding: 8px 0;
            flex-wrap: wrap;
        }

        .cat-icon-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            max-width: 90px;
            text-align: center;
        }

        .cat-icon-circle {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f2f6f1;
            border: 2px solid #e2e9e1;
            transition: border-color .2s, transform .2s;
        }

        .cat-icon-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cat-icon-item:hover .cat-icon-circle,
        .cat-icon-item.active .cat-icon-circle {
            border-color: #3BB77E;
            transform: translateY(-2px);
        }

        .cat-icon-name {
            font-size: 13px;
            font-weight: 600;
            color: #253D4E;
            line-height: 1.2;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .cat-icon-item:hover .cat-icon-name,
        .cat-icon-item.active .cat-icon-name {
            color: #3BB77E;
        }

        .cat-icon-circle-sm {
            width: 36px;
            height: 36px;
            flex: 0 0 36px;
        }

        .mobile-cat-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 0;
            font-weight: 600;
            color: #253D4E;
        }

        /* ── Mobile category strip (horizontal scroll under header) ──── */
        .mobile-cat-strip {
            display: flex;
            gap: 18px;
            padding: 10px 15px;
            overflow-x: auto;
            background: #fff;
            border-top: 1px solid #ececec;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }

        .mobile-cat-strip::-webkit-scrollbar {
            display: none;
        }

        .mobile-cat-strip-item {
            flex: 0 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            width: 68px;
            text-align: center;
        }

        .mobile-cat-strip-item .cat-icon-circle {
            width: 46px;
            height: 46px;
        }

        .mobile-cat-strip-item .cat-icon-name {
            font-size: 11px;
        }

        .mobile-cat-strip-item.active .cat-icon-circle {
            border-color: #3BB77E;
        }

        .mobile-cat-strip-item.active .cat-icon-name {
            color: #3BB77E;
        }

        /* ── Uniform product cards ───────────────────────────────────── */
        .product-cart-wrap {
            display: flex;
            flex-direction: column;
            height: calc(100% - 30px);
        }

        .product-cart-wrap .product-img-action-wrap {
            flex-shrink: 0;
        }

        .product-cart-wrap .product-img img.default-img,
        .product-cart-wrap .product-img img.hover-img {
            width: 100%;
            aspect-ratio: 1 / 1;
            object-fit: cover;
        }

        .product-cart-wrap .product-content-wrap {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .product-cart-wrap .product-content-wrap h2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 2.6em;
        }

        .product-cart-wrap .product-content-wrap .product-price {
            margin-top: auto;
        }
    </style>
    @yield('style')
</head>

<body>

    @include('frontend.layouts.notification')
    <!-- Header -->
    @include('frontend.layouts.header')
    <!--/ End Header -->
    @yield('main-content')
    @include('frontend.layouts.footer')

</body>

</html>
