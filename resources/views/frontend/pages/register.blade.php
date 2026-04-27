@extends('frontend.layouts.master')

@section('title', 'Fulvari || Register Page')

@section('main-content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> Register
                </div>
            </div>
        </div>
        <section class="pt-1 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Create an Account</h3>
                                        </div>
                                        <form method="post" action="{{ route('register.submit') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" required="" value="{{ old('name') }}"
                                                    name="name" placeholder="Username">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="text" required="" value="{{ old('email') }}"
                                                    name="email" placeholder="Email">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input required="" value="{{ old('password') }}" type="password"
                                                    name="password" placeholder="Password">
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input required="" value="{{ old('password_confirmation') }}"
                                                    type="password" name="password_confirmation"
                                                    placeholder="Confirm password">
                                                @error('password_confirmation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox"
                                                            id="exampleCheckbox12" value="">
                                                        {{-- <label class="form-check-label" for="exampleCheckbox12"><span>I
                                                                agree to terms &amp; Policy.</span></label> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up"
                                                    name="login">Submit &amp; Register</button>
                                            </div>
                                        </form>
                                        {{-- OR
                                                                                                <a href="{{ route('login.redirect', 'facebook') }}" class="btn btn-facebook"><i class="ti-facebook"></i></a>
                                                                                                <a href="{{ route('login.redirect', 'github') }}" class="btn btn-github"><i class="ti-github"></i></a>
                                                                                                <a href="{{ route('login.redirect', 'google') }}" class="btn btn-google"><i class="ti-google"></i></a> --}}
                                        {{-- <div class="divider-text-center mt-15 mb-15">
                                            <span> or</span>
                                        </div> 
                                        <ul class="btn-login list_none text-center mb-15">
                                            <li><a href="#" class="btn btn-facebook hover-up mb-lg-0 mb-sm-4">Login
                                                    With Facebook</a></li>
                                            <li><a href="#" class="btn btn-google hover-up">Login With Google</a></li>
                                        </ul> --}}
                                        <div class="text-muted text-center">Already have an account? <a
                                                href="{{ route('login.form') }}">Sign
                                                in now</a></div>
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
