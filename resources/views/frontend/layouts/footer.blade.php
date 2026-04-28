<footer class="main">
    <section class="section-padding footer-mid">
        <div class="container pt-15 pb-20">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="widget-about font-md mb-md-5 mb-lg-0">
                        <div class="logo logo-width-1 wow fadeIn animated animated animated" style="visibility: visible;">
                            <a href="javascript:void(0)"><img src="{{ asset('frontend/images/filvari-logo.jpeg') }}" alt="logo"></a>
                        </div>
                        <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated animated animated"
                            style="visibility: visible;">Contact</h5>
                        <p class="wow fadeIn animated animated animated" style="visibility: visible;">
                            <strong>Address: </strong> Sri Krishna Puri Boring road Patna 800001.
                        </p>
                        <p class="wow fadeIn animated animated animated" style="visibility: visible;">
                            <strong>Phone: </strong>+91 7667459049 /(+91) 7667459049
                        </p>
                        <p class="wow fadeIn animated animated animated" style="visibility: visible;">
                            <strong>Hours: </strong>10:00 - 18:00, Mon - Sat
                        </p>
                        <h5 class="mb-10 mt-30 fw-600 text-grey-4 wow fadeIn animated animated animated"
                            style="visibility: visible;">Follow Us</h5>
                        <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0 animated animated"
                            style="visibility: visible;">
                            <a href="#">
                                <img src="{{ asset('frontend/images/icon-facebook.svg') }}" alt="">
                            </a>
                            <a href="#">
                                <img src="{{ asset('frontend/images/icon-twitter.svg') }}" alt="">
                            </a>
                            <a href="#">
                                <img src="{{ asset('frontend/images/icon-instagram.svg') }}" alt="">
                            </a>
                            <a href="#">
                                <img src="{{ asset('frontend/images/icon-pinterest.svg') }}" alt="">
                            </a>
                            <a href="#">
                                <img src="{{ asset('frontend/images/icon-youtube.svg') }}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <h5 class="widget-title wow fadeIn animated animated animated" style="visibility: visible;">About
                    </h5>
                    <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0 animated animated"
                        style="visibility: visible;">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Delivery Information</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms &amp; Conditions</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-3  col-md-3">
                    <h5 class="widget-title wow fadeIn animated animated animated" style="visibility: visible;">My
                        Account</h5>
                    <ul class="footer-list wow fadeIn animated animated animated" style="visibility: visible;">
                        <li><a href="{{ route('login') }}">Sign In</a></li>
                        <li><a href="{{ route('cart') }}">View Cart</a></li>
                        <li><a href="/wishlist">My Wishlist</a></li>
                        <li><a href="/track-order">Track My Order</a></li>
                        <li><a href="/order">Order</a></li>
                    </ul>
                </div>
                {{-- <div class="col-lg-4">
                    <h5 class="widget-title wow fadeIn animated animated animated" style="visibility: visible;">Install
                        App</h5>
                    <div class="row">
                        <div class="col-md-8 col-lg-12">
                            <p class="wow fadeIn animated animated animated" style="visibility: visible;">From App Store
                                or Google Play</p>
                            <div class="download-app wow fadeIn animated animated animated"
                                style="visibility: visible;">
                                <a href="#" class="hover-up mb-sm-4 mb-lg-0"><img class="active"
                                        src="assets/imgs/theme/app-store.jpg" alt=""></a>
                                <a href="#" class="hover-up"><img src="assets/imgs/theme/google-play.jpg"
                                        alt=""></a>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-12 mt-md-3 mt-lg-0">
                            <p class="mb-20 wow fadeIn animated animated animated" style="visibility: visible;">
                                Secured Payment Gateways</p>
                            <img class="wow fadeIn animated animated animated"
                                src="assets/imgs/theme/payment-method.png" alt="" style="visibility: visible;">
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <div class="container pb-20 wow fadeIn animated animated animated" style="visibility: visible;">
        <div class="row">
            <div class="col-12 mb-20">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-lg-6">
                <p class="float-md-left font-sm text-muted mb-0">© 2026, <strong class="text-brand">Chandan</strong> -
                    chandan20004.techaccess@gmail.com</p>
            </div>
            <div class="col-lg-6">
                <p class="text-lg-end text-start font-sm text-muted mb-0">
                    Developed by <a href="mailto:chandan2004.techaccess@gmail.com">Chandan</a>.
                    All rights reserved
                </p>
            </div>
        </div>
    </div>
</footer>
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="text-center">
                <h5 class="mb-10">Now Loading</h5>
                <div class="loader">
                    <div class="bar bar1"></div>
                    <div class="bar bar2"></div>
                    <div class="bar bar3"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('frontend/js/modernizr-3.6.0.min.js') }}"></script>
{{-- <script src="https://wp.alithemes.com/html/evara/evara-frontend/assets/js/vendor/jquery-3.6.0.min.js"></script> --}}
<script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-migrate-3.3.0.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/js/slick.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.syotimer.min.js') }}"></script>
<script src="{{ asset('frontend/js/wow.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-ui.js') }}"></script>
<script src="{{ asset('frontend/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('frontend/js/magnific-popup.js') }}"></script>
<script src="{{ asset('frontend/js/select2.min.js') }}"></script>
<script src="{{ asset('frontend/js/waypoints.js') }}"></script>
<script src="{{ asset('frontend/js/counterup.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('frontend/js/images-loaded.js') }}"></script>
<script src="{{ asset('frontend/js/isotope.js') }}"></script>
<script src="{{ asset('frontend/js/scrollup.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.vticker-min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.theia.sticky.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.elevatezoom.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
<script src="{{ asset('frontend/js/shop.js') }}"></script>
@stack('scripts')
