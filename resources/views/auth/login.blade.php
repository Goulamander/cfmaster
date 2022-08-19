<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('media/admin/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('media/admin/img/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="shortcut icon" href="{{ asset('media/logo.png') }}">
    <title>CF-Master Login </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="{{ asset('media/admin/css/font-awesome.min.css') }}">
    <link href="{{ asset('media/admin/css/material-dashboard.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('media/admin/demo/demo.css') }}" rel="stylesheet" />
    <link href="{{ asset('media/css/core.css') }}" rel="stylesheet" />

</head>

<body class="off-canvas-sidebar">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
        <div class="container">
            <div class="navbar-wrapper">
                <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('media/logo.png') }}"
                        width="90px"></a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item ">
                                <a href="{{ route('login') }}" class="nav-link"
                                    style="background: linear-gradient(60deg,#60cab3,#67ceb9);">
                                    <i class="material-icons">fingerprint</i>
                                    Login
                                </a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item  active ">
                                <a href="{{ route('register') }}" class="nav-link"
                                    style="background: linear-gradient(60deg,#60cab3,#67ceb9);">
                                    <i class="material-icons">person_add</i>
                                    Register
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link"
                                style="background: linear-gradient(60deg,#60cab3,#67ceb9);">
                                <i class="material-icons">dashboard</i>
                                Dashboard
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="wrapper wrapper-full-page">
        <div class="page-header login-page" filter-color="black">
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                        <form method="POST" class="form" action="{{ route('login') }}">
                            @csrf
                            <div class="card card-login card-hidden">
                                <div class="card-header card-header-rose text-center">
                                    <h4 class="card-title">Login</h4>
                                </div>
                                <div class="card-body ">
                                    <span class="bmd-form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons" style="color: #36a18b">email</i>
                                                </span>
                                            </div>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus
                                                placeholder="Email...">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </span>
                                    <span class="bmd-form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons" style="color: #36a18b">lock_outline</i>
                                                </span>
                                            </div>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password"
                                                placeholder="Password..." minlength="6" required="true"
                                                aria-required="true" aria-invalid="true">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </span>
                                </div>
                                <div class="card-footer justify-content-center">
                                    <button type="submit" class="btn btn-rose btn-link btn-lg" style="color: #36a18b;">
                                        {{ __('Lets Go') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <!-- <div class="copyright float-right">
            &copy;
            <script>
                document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i> by
            <a href="https://www.creative-tim.com/" target="_blank">Creative Tim</a> for a better web.
          </div> -->
                </div>
            </footer>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('media/admin/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('media/admin/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('media/admin/js/core/bootstrap-material-design.min.js') }}"></script>
    <script src="{{ asset('media/admin/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('media/admin/js/material-dashboard.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('media/admin/js/plugins/jquery.validate.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            md.checkFullPageBackgroundImage();
            setTimeout(function() {
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 300);
        });
    </script>
</body>

</html>
