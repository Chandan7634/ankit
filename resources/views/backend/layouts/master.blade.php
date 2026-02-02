<!DOCTYPE html>
<html lang="en">
@include('backend.layouts.head')

<body>

    <!-- START Wrapper -->
    <div class="wrapper">

        <!-- ========== Topbar Start ========== -->
        @include('backend.layouts.header')

        <!-- ========== App Menu Start ========== -->
        @include('backend.layouts.sidebar')
        <div class="page-content">
            <div class="container-xxl">

                @yield('main-content')
                @include('backend.layouts.footer')
            </div>
</body>

</html>
