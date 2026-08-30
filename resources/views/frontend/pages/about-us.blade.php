@extends('frontend.layouts.master')

@section('title', 'Fulvari || About Us')

@section('main-content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow">Home</a>
                    <span></span> About Us
                </div>
            </div>
        </div>

        <!-- Intro -->
        <section class="about-intro pt-60 pb-40">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-9 text-center">
                        <span class="about-eyebrow">Who we are</span>
                        <h1 class="about-title mb-20">Welcome to <span class="text-brand">Fulvari</span></h1>
                        @if ($site->short_des)
                            <p class="about-lead">{{ strip_tags($site->short_des) }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- Story -->
        @if ($site->description)
            <section class="about-story pb-50">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="about-story-card">
                                <h3 class="mb-20">Our Story</h3>
                                <div class="about-story-body">
                                    {!! $site->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- What we stand for -->
        <section class="about-values pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center mb-40">
                        <h3>What We Stand For</h3>
                        <p class="text-muted">The promises behind every order we pack.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-6">
                        <div class="about-value-card">
                            <i class="fi-rs-shopping-cart-check"></i>
                            <h5>Free Shipping</h5>
                            <p>On orders over &#8377;1000</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6">
                        <div class="about-value-card">
                            <i class="fi-rs-refresh"></i>
                            <h5>Easy Returns</h5>
                            <p>Within 30 days of delivery</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6">
                        <div class="about-value-card">
                            <i class="fi-rs-lock"></i>
                            <h5>Secure Payment</h5>
                            <p>100% protected checkout</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6">
                        <div class="about-value-card">
                            <i class="fi-rs-label"></i>
                            <h5>Best Price</h5>
                            <p>Guaranteed value, always</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Reach us -->
        <section class="about-contact pb-60">
            <div class="container">
                <div class="about-contact-wrap">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h3 class="mb-15">Have a question for us?</h3>
                            <ul class="about-contact-list">
                                @if ($site->phone)
                                    <li>
                                        <i class="fi-rs-phone-call"></i>
                                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $site->phone) }}">{{ $site->phone }}</a>
                                    </li>
                                @endif
                                @if ($site->email)
                                    <li>
                                        <i class="fi-rs-envelope"></i>
                                        <a href="mailto:{{ $site->email }}">{{ $site->email }}</a>
                                    </li>
                                @endif
                                @if ($site->address)
                                    <li>
                                        <i class="fi-rs-marker"></i>
                                        <span>{{ $site->address }}</span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-30 mt-lg-0">
                            <a href="{{ route('contact') }}" class="btn btn-fill-out hover-up">Contact Us</a>
                            <a href="{{ route('blog') }}" class="btn btn-border hover-up ms-2">Our Blog</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('frontend.layouts.newsletter')
@endsection

@push('styles')
    <style>
        .about-eyebrow {
            display: inline-block;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: #3BB77E;
            margin-bottom: 12px;
        }

        .about-title {
            font-size: 42px;
            font-weight: 700;
            color: #253D4E;
        }

        .about-lead {
            font-size: 17px;
            line-height: 1.8;
            color: #7E7E7E;
            margin-bottom: 0;
        }

        .about-story-card {
            background: #fff;
            border: 1px solid #ececec;
            border-radius: 15px;
            padding: 40px;
        }

        .about-story-card h3 {
            color: #253D4E;
        }

        .about-story-body,
        .about-story-body p {
            font-size: 16px;
            line-height: 1.9;
            color: #7E7E7E;
        }

        .about-story-body p:last-child {
            margin-bottom: 0;
        }

        .about-values h3,
        .about-contact-wrap h3 {
            color: #253D4E;
        }

        .about-value-card {
            height: 100%;
            background: #fff;
            border: 1px solid #ececec;
            border-radius: 15px;
            padding: 28px 20px;
            text-align: center;
            transition: transform .25s, box-shadow .25s, border-color .25s;
            margin-bottom: 24px;
        }

        .about-value-card:hover {
            transform: translateY(-4px);
            border-color: #3BB77E;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .06);
        }

        .about-value-card i {
            display: inline-block;
            font-size: 26px;
            color: #3BB77E;
            width: 62px;
            height: 62px;
            line-height: 62px;
            border-radius: 50%;
            background: #f2f9f5;
            margin-bottom: 16px;
        }

        .about-value-card h5 {
            color: #253D4E;
            margin-bottom: 6px;
        }

        .about-value-card p {
            font-size: 14px;
            color: #7E7E7E;
            margin-bottom: 0;
        }

        .about-contact-wrap {
            background: #f2f9f5;
            border-radius: 15px;
            padding: 40px;
        }

        .about-contact-list {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .about-contact-list li {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 16px;
            color: #253D4E;
            padding: 6px 0;
        }

        .about-contact-list li i {
            color: #3BB77E;
        }

        .about-contact-list li a {
            color: #253D4E;
        }

        .about-contact-list li a:hover {
            color: #3BB77E;
        }

        @media (max-width: 767.98px) {
            .about-title {
                font-size: 30px;
            }

            .about-lead {
                font-size: 15px;
            }

            .about-story-card,
            .about-contact-wrap {
                padding: 24px;
            }

            .about-value-card {
                padding: 22px 12px;
            }

            .about-value-card i {
                width: 52px;
                height: 52px;
                line-height: 52px;
                font-size: 22px;
            }
        }
    </style>
@endpush
