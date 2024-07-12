<!DOCTYPE html>
<html lang="en">

<head>
    <title>Real Estate</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('front_assets/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('front_assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('front_assets/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('front_assets/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('front_assets/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/jquery.timepicker.css') }}">


    <link rel="stylesheet" href="{{ asset('front_assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/style.css') }}">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light " id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="/"> <span class="logo-name"><img src="{{ asset('front_assets/images/logo.png') }}" alt="Logo" style="width: 100px; height:100px;"></span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menus
            </button>


            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="/" class="nav-link">Home</a></li>
                    @if (Auth::guard('customer')->check())
                        <li class="nav-item"><a href="/property-booking" class="nav-link">Property Booking</a></li>
                    @else
                        <li class="nav-item"><a href="/flogin" class="nav-link">Property Booking</a></li>
                    @endif
                    <li class="nav-item"><a href="/customer-review" class="nav-link">Review</a></li>
                    <li class="nav-item"><a href="/contact-us" class="nav-link">Contact</a></li>
                    @if (Auth::guard('customer')->check())
                        <li class="nav-item"><a class="nav-link"
                                disabled>{{ Auth::guard('customer')->user()->customer_fname }}</a></li>
                        <li class="nav-item"><a href="/customer-logout" class="nav-link">Log Out</a></li>
                    @else
                        <li class="nav-item"><a href="/flogin" class="nav-link">Login</a></li>
                        <li class="nav-item"><a href="/customer-register" class="nav-link">Register</a></li>
                        <li class="nav-item"><a href="/seller-register" class="nav-link">Seller Register</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->


    <main>
        {{-- main content start --}}
        <div>

            {{ $slot }}
        </div>

        {{-- main content end --}}
    </main>


    <footer class="ftco-footer ftco-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Real Estate</h2>
                        <p>Far far away, behind the word mountains, far from the countries.</p>
                        <ul class="ftco-footer-social list-unstyled mt-5">
                            <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-4">
                        <h2 class="ftco-heading-2">Community</h2>
                        <ul class="list-unstyled">
                            <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Search
                                    Properties</a></li>
                            <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>For Agents</a></li>
                            <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Reviews</a></li>
                            <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>FAQs</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-4">
                        <h2 class="ftco-heading-2">About Us</h2>
                        <ul class="list-unstyled">
                            <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Our Story</a></li>
                            <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Meet the team</a>
                            </li>
                            <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Careers</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Company</h2>
                        <ul class="list-unstyled">
                            <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>About Us</a></li>
                            <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Have a Questions?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span class="text">No.304, K.K.S Road, Jaffna</span></li>
                                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+94 76 12 58 456</span></a></li>
                                <li><a href="#"><span class="icon icon-envelope pr-4"></span><span
                                            class="text">realestate@info.com</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">

                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </footer>



    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>

    <script src="{{ asset('front_assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('front_assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/aos.js') }}"></script>
    <script src="{{ asset('front_assets/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('front_assets/js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/scrollax.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{ asset('front_assets/js/google-map.js') }}"></script>
    <script src="{{ asset('front_assets/js/main.js') }}"></script>

</body>

</html>
