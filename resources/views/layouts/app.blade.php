<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('media/admin/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('media/logo.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        CF Master
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="{{ asset('media/admin/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('media/admin/js/plugins/ijabocroptool/ijaboCropTool.min.css')}}">
    <link href="{{ asset('media/admin/css/material-dashboard.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('media/css/core.css') }}" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="">
    <div class="wrapper ">
        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- End Sidebar -->
        <div class="main-panel">
            <!-- Navbar -->
            @include('layouts.topbar')
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <!-- Container -->
                    @yield('content')
                    <!-- End Container -->
                </div>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('media/admin/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('media/js/core.js') }}"></script>
    <script src="{{ asset('media/admin/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('media/admin/js/core/bootstrap-material-design.min.js') }}"></script>
    <script src="{{ asset('media/admin/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('media/admin/js/material-dashboard.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('media/admin/js/plugins/sweetalert.min.js') }}"></script>
    <script src="{{asset('media/admin/js/plugins/ijabocroptool/ijaboCropTool.min.js')}}"></script>
    <!-- Custom Core JS Files   -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="{{ asset('media/admin/js/plugins/bootstrap-selectpicker.js') }}"></script>
    @yield('script')
</body>

</html>
