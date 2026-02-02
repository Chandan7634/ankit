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
