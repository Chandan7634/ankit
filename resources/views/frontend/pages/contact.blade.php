@extends('frontend.layouts.master')

@section('title', 'Fulvari || Contact Us')

@section('main-content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow">Home</a>
                    <span></span> Contact
                </div>
            </div>
        </div>

        <section class="contact-page pt-60 pb-60">
            <div class="container">
                <div class="row justify-content-center mb-40">
                    <div class="col-lg-8 text-center">
                        <span class="contact-eyebrow">Get in touch</span>
                        <h1 class="contact-title">We would love to hear from you</h1>
                        <p class="contact-lead">Questions about an order, a plant, or a bulk enquiry — send us a
                            message and we will get back to you.</p>
                    </div>
                </div>

                <div class="row">
                    <!-- Contact details -->
                    <div class="col-lg-4 mb-30">
                        <div class="contact-info-wrap">
                            @if ($site->phone)
                                <div class="contact-info-item">
                                    <span class="contact-info-icon"><i class="fi-rs-phone-call"></i></span>
                                    <div>
                                        <h5>Call us</h5>
                                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $site->phone) }}">{{ $site->phone }}</a>
                                    </div>
                                </div>
                            @endif
                            @if ($site->email)
                                <div class="contact-info-item">
                                    <span class="contact-info-icon"><i class="fi-rs-envelope"></i></span>
                                    <div>
                                        <h5>Email us</h5>
                                        <a href="mailto:{{ $site->email }}">{{ $site->email }}</a>
                                    </div>
                                </div>
                            @endif
                            @if ($site->address)
                                <div class="contact-info-item">
                                    <span class="contact-info-icon"><i class="fi-rs-marker"></i></span>
                                    <div>
                                        <h5>Visit us</h5>
                                        <p>{{ $site->address }}</p>
                                        <a class="contact-directions"
                                            href="https://www.google.com/maps/search/?api=1&query={{ urlencode($site->address) }}"
                                            target="_blank" rel="noopener">Get directions</a>
                                    </div>
                                </div>
                            @endif
                            <div class="contact-info-item">
                                <span class="contact-info-icon"><i class="fi-rs-clock"></i></span>
                                <div>
                                    <h5>Opening hours</h5>
                                    <p>Mon &ndash; Sat, 10:00 &ndash; 18:00</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Message form -->
                    <div class="col-lg-8">
                        <div class="contact-form-wrap">
                            <h4 class="mb-25">Write us a message</h4>
                            <form class="form-contact contact_form" method="post" action="{{ route('contact.store') }}"
                                id="contactForm">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name">Your Name <span>*</span></label>
                                            <input name="name" id="name" type="text" required
                                                value="{{ old('name') }}" placeholder="Enter your name">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="subject">Subject <span>*</span></label>
                                            <input name="subject" id="subject" type="text" required
                                                value="{{ old('subject') }}" placeholder="Enter subject">
                                            @error('subject')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email">Your Email <span>*</span></label>
                                            <input name="email" id="email" type="email" required
                                                value="{{ old('email') }}" placeholder="Enter email address">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="phone">Your Phone <span>*</span></label>
                                            <input name="phone" id="phone" type="tel" required
                                                value="{{ old('phone') }}" placeholder="Enter your phone">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="message">Your Message <span>*</span></label>
                                            <textarea name="message" id="message" cols="30" rows="8" required placeholder="Enter message">{{ old('message') }}</textarea>
                                            @error('message')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-fill-out btn-block hover-up">Send
                                            Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Map -->
        @if ($site->address)
            <section class="contact-map-section">
                <iframe title="Our location on Google Maps"
                    src="https://www.google.com/maps?q={{ urlencode($site->address) }}&output=embed"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </section>
        @endif
    </main>
@endsection

@push('styles')
    <style>
        .contact-eyebrow {
            display: inline-block;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: #3BB77E;
            margin-bottom: 12px;
        }

        .contact-title {
            font-size: 38px;
            font-weight: 700;
            color: #253D4E;
            margin-bottom: 12px;
        }

        .contact-lead {
            font-size: 16px;
            line-height: 1.8;
            color: #7E7E7E;
            margin-bottom: 0;
        }

        .contact-info-wrap {
            background: #f2f9f5;
            border-radius: 15px;
            padding: 30px;
            height: 100%;
        }

        .contact-info-item {
            display: flex;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid #e2ece6;
        }

        .contact-info-item:first-child {
            padding-top: 0;
        }

        .contact-info-item:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .contact-info-icon {
            flex: 0 0 46px;
            width: 46px;
            height: 46px;
            line-height: 46px;
            text-align: center;
            border-radius: 50%;
            background: #fff;
            color: #3BB77E;
            font-size: 18px;
        }

        .contact-info-item h5 {
            font-size: 15px;
            color: #253D4E;
            margin-bottom: 4px;
        }

        .contact-info-item p,
        .contact-info-item a {
            font-size: 15px;
            color: #7E7E7E;
            margin-bottom: 0;
            word-break: break-word;
        }

        .contact-info-item a:hover {
            color: #3BB77E;
        }

        .contact-directions {
            display: inline-block;
            margin-top: 6px;
            font-weight: 600;
            color: #3BB77E !important;
        }

        .contact-form-wrap {
            background: #fff;
            border: 1px solid #ececec;
            border-radius: 15px;
            padding: 35px;
        }

        .contact-form-wrap h4 {
            color: #253D4E;
        }

        .contact-form-wrap .form-group {
            margin-bottom: 20px;
        }

        .contact-form-wrap label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #253D4E;
            margin-bottom: 8px;
        }

        .contact-form-wrap label span {
            color: #e6483d;
        }

        .contact-form-wrap input,
        .contact-form-wrap textarea {
            width: 100%;
            border: 1px solid #ececec;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 15px;
            background: #fff;
            transition: border-color .2s;
        }

        .contact-form-wrap input:focus,
        .contact-form-wrap textarea:focus {
            border-color: #3BB77E;
            outline: none;
        }

        .contact-map-section {
            line-height: 0;
        }

        .contact-map-section iframe {
            display: block;
            width: 100%;
            filter: grayscale(12%);
        }

        @media (max-width: 767.98px) {
            .contact-title {
                font-size: 28px;
            }

            .contact-info-wrap,
            .contact-form-wrap {
                padding: 22px;
            }

            .contact-map-section iframe {
                height: 320px;
            }
        }
    </style>
@endpush
