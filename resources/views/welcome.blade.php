<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CF Master">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('media/logo.png') }}">
    <!-- Site Title  -->
    <title>CF-Master</title>
    <!-- Vendor Bundle CSS -->
    <link rel="stylesheet" href="{{ asset('media/landing/assets/css/bootstrap.css?ver=100') }}">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ asset('media/landing/assets/css/style.css?ver=100') }}">
    <link rel="stylesheet" href="{{ asset('media/landing/assets/css/theme.css?ver=100') }}" id="layoutstyle">
</head>

<body data-spy="scroll" data-target="#mainnav" data-offset="80" class="aster">

    <!-- HEADER AREA STARTS -->

    <div class="header-area" id="home">

        <header class="site-header is-sticky">

            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light is-transparent" id="mainnav">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('media/logo.png') }}" width="90px">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-icon">
                            <i class="fas fa-bars"></i>
                        </span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo01">
                        <ul class="navbar-nav">
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#pricing">Pricing</a>
                                </li>
                                @auth
                                    <li class="nav-item">
                                        <a href="{{ url('/home') }}" class="btn-menu">Dashboard</a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a href="{{ route('register') }}" class="btn-menu">Sign up</a>
                                        </li>
                                    @endif
                                @endauth
                            @endif
                        </ul> <!-- navbar -->

                    </div>
                </div> <!-- Container -->
            </nav>
            <!-- End Navbar -->

        </header>
    </div>
    <!-- HEADER AREA ENDS -->
    <!--  CONFIG STARTS  -->
    <div class="why-this section-pad nopb" id="about">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="sec-heading">
                        <h2 class="sec-title-lg">Why choose this?</h2>
                        <p class="lead">Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
                    </div>
                </div> <!-- col -->
            </div> <!-- row -->
        </div> <!-- Container -->
    </div>
    <div class="config">
        <div class="config-shape">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                viewBox="0 0 750.6 859">
                <path d="M0,0v44.5c0,0,58-29,100-39s82-5,107,12s47,38,99,49s157,18,205,21s127,12,171,32s51,64,60,108s2,152-32,225
                        s-87,132-172,164s-115,51-165,93s-114,104-166,131s-128,32-207-38V859h1920V0H0z" />
            </svg>
        </div>
        <div class="container">
            <div class="row justify-content-between align-items-center">

                <div class="col-md-6">
                    <div class="config-img sec-img">
                        <img src="{{ asset('media/landing/images/easy-config.png') }}" alt="config">
                    </div>
                </div> <!-- col -->

                <div class="col-md-5 text-center text-md-left">
                    <div class="text-block">
                        <h2 class="sec-title-lg sec-title-md">Easy configuration <br class="d-none d-md-block"> for
                            anyone.</h2>
                        <p class="lead">Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.nostrud exercitation
                            ullamco laboris nisi ut aliquip</p>
                        <a href="#" class="btn-link">Read More</a>
                    </div>
                </div> <!-- col -->

            </div> <!-- row -->
        </div> <!-- Container -->
    </div>
    <div class="why-this">
        <div class="container">
            <div class="row justify-content-between align-items-center">

                <div class="col-md-6">
                    <div class="sec-img">
                        <img src="{{ asset('media/landing/images/tools.png') }}" alt="tools">
                    </div>
                </div> <!-- col -->

                <div class="col-md-5 text-center text-md-right order-last order-md-first">
                    <div class="text-block">
                        <h2 class="sec-title-lg sec-title-md">Unlimited usefull tools in one click.</h2>
                        <p class="lead">Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.nostrud exercitation
                            ullamco laboris nisi ut aliquip</p>
                        <a href="#" class="btn-link">Read More</a>
                    </div>
                </div> <!-- col -->

            </div> <!-- row -->
        </div> <!-- Container -->
    </div>
    <!--  TOOLS ENDS -->
    <div class="quick-access">
        <div class="pt"></div>
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-6">
                    <div class="quick-access-img sec-img">
                        <img src="{{ asset('media/landing/images/why-xiom.png') }}" alt="why-us">
                    </div>
                </div> <!-- col -->

                <div class="col-md-5 text-center text-md-left">
                    <div class="text-block-3">
                        <div class="quick-access-text">
                            <h2 class="sec-title-lg">Quick access</h2>
                            <p class="lead">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.
                            </p>
                        </div>
                    </div>
                </div> <!-- col -->
            </div> <!-- row -->
        </div> <!-- Container -->
    </div>
    <div class="pricing section-pad nopb" id="pricing">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="sec-heading">
                        <h2 class="sec-title-lg">Best pricing</h2>
                        <p class="sec-text-pad lead">Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. </p>
                    </div>
                </div> <!-- col -->
            </div> <!-- row -->

            <div class="row justify-content-center text-center">

                <div class="col-lg-4 col-md-6">
                    <div class="pricing-box">
                        <h2 class="pricing-title">Starter</h2>
                        <span class="pricing-price"> <sup>$</sup> 14 </span>
                        <span class="pricing-note">Per month</span>
                        <ul class="pricing-list">
                            <li> laoreet lacus lacinia. </li>
                            <li>Nulla facilisi.</li>
                            <li>Sed aliquet vel massa a finibus. </li>
                            <li> a ornare metus.</li>
                            <li>Free update</li>
                        </ul>
                        <a href="#" class="btn-lg btn-price">Get started</a>
                    </div>
                </div> <!-- col -->

                <div class="col-lg-4 col-md-6">
                    <div class="pricing-box">
                        <h2 class="pricing-title">Premium</h2>
                        <span class="pricing-price"> <sup>$</sup> 24 </span>
                        <span class="pricing-note">Per month</span>
                        <ul class="pricing-list">
                            <li> laoreet lacus lacinia. </li>
                            <li>Nulla facilisi.</li>
                            <li>Sed aliquet vel massa a finibus. </li>
                            <li> a ornare metus.</li>
                            <li>Free update</li>
                        </ul>
                        <a href="#" class="btn-lg btn-price">Get started</a>
                    </div>
                </div> <!-- col -->

                <div class="col-lg-4 col-md-6">
                    <div class="pricing-box">
                        <h2 class="pricing-title">Pro</h2>
                        <span class="pricing-price"> <sup>$</sup> 34</span>
                        <span class="pricing-note">Per month</span>
                        <ul class="pricing-list">
                            <li> laoreet lacus lacinia. </li>
                            <li>Nulla facilisi.</li>
                            <li>Sed aliquet vel massa a finibus. </li>
                            <li> a ornare metus.</li>
                            <li>Free update</li>
                        </ul>
                        <a href="#" class="btn-lg btn-price">Get started</a>
                    </div>
                </div> <!-- col -->

            </div>
            <!--row-->
        </div> <!-- Container-->
    </div>
    <!--  FOOTER STARTS -->
    <div class="up-icon">
        <i class="fas fa-angle-double-up fa-lg"></i>
    </div>
    {{-- <div class="footer-area nopd" id="contact">
        <div class="container">
            <div class="footer-content">
                <div class="up-icon">
                    <i class="fas fa-angle-double-up fa-lg"></i>
                </div>
            </div> <!-- Footer-content -->
            <div class="footer-text text-center">
                <p>© 2018 XIOM, All rights reserved by Softnio.</p>
            </div>
        </div> <!-- Container -->
    </div>
    <!--  FOOTER ENDS --> --}}

    <!-- JavaScript (include all script here) -->
    <script src="{{ asset('media/landing/assets/js/jquery.bundled751.js?ver=100') }}"></script>
    <script src="=" {{ asset('media/landing/assets/js/scriptd751.js?ver=100') }}"></script>

</body>

</html>
