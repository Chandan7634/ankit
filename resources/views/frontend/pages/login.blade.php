@extends('frontend.layouts.master')

@section('title', 'Ecommerce Laravel || Login Page')

@section('main-content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="../" rel="nofollow">Home</a>
                    <span></span> Login
                </div>
            </div>
        </div>
        <section class="pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div
                                    class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Login</h3>
                                        </div>
                                        <form method="post" action="{{ route('login.submit') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" class="mb-2" required=""
                                                    value="{{ old('email') }}" name="email" placeholder="Your Email">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <input required="" value="{{ old('password') }}" type="password" name="password"
                                            placeholder="Password">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="login_footer form-group">
                                        <div class="chek-form">
                                            <div class="custome-checkbox">
                                                <input class="form-check-input" name="news" id="2"
                                                    type="checkbox" name="news" value="">
                                                <label class="form-check-label" for="2"><span>Remember
                                                        me</span></label>
                                            </div>
                                        </div>
                                        {{-- @if (Route::has('password.request'))
                                            <a class="text-muted lost-pass" href="{{ route('password.reset') }}">Forgot
                                                password?</a>
                                            </a>
                                        @endif --}}
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-fill-out btn-block hover-up"
                                            name="login">Log
                                            in</button>
                                    </div>
                                    <!-- OR
                                                                                                                                                                                                                            <a href="{{ route('login.redirect', 'facebook') }}" class="btn btn-facebook"><i class="ti-facebook"></i></a>
                                                                                                                                                                                                                            <a href="{{ route('login.redirect', 'github') }}" class="btn btn-github"><i class="ti-github"></i></a>
                                                                                                                                                                                                                            <a href="{{ route('login.redirect', 'google') }}" class="btn btn-google"><i class="ti-google"></i></a> -->
                                    </form>
                                    <div class="text-muted text-center">Don't have account? <a
                                            href="{{ route('register.form') }}">Register</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </main>
@endsection
@push('styles')
    <style>
        .shop.login .form .btn {
            margin-right: 0;
        }

        .btn-facebook {
            background: #39579A;
        }

        .btn-facebook:hover {
            background: #073088 !important;
        }

        .btn-github {
            background: #444444;
            color: white;
        }

        .btn-github:hover {
            background: black !important;
        }

        .btn-google {
            background: #ea4335;
            color: white;
        }

        .btn-google:hover {
            background: rgb(243, 26, 26) !important;
        }
    </style>
@endpush
