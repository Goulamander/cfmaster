<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-minimize">
                <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                    <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                    <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                </button>
            </div>
            <a class="navbar-brand" href="javascript:;">@yield('title')</a>
            <?php if (request()->is('products')) { ?>
            {{-- <div class="col-lg-9 col-md-6 col-sm-3" style="background-color: #67ceb9; border-color: #67ceb9; border-radius: 30px;">
                    <select class="selectpicker" name="currentYear" data-style="select-with-transition" title="Select Year" data-size="8">
                      <option disabled>Select Year</option>
                      <option value="2021">2021</option>
                      <option value="2022">2022</option>
                      <option value="2023">2023</option>
                      <option value="2024">2024</option>
                      <option value="2025">2025</option>
                      <option value="2026">2026</option>
                      <option value="2027">2027</option>
                    </select>
                  </div> --}}
            <?php } ?>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form"></form>
            <ul class="navbar-nav">
                <?php if (request()->is('products')) { ?>
                <li class="nav-item">
                    <div class="togglebutton" style="margin-bottom: -4px;">
                        <label style="color: #67ceb9;">
                        <input type="checkbox" id="change-report" onchange="changeReport()">
                        Product orders
                        <span class="toggle"></span>
                        Earnings of Sales
                        </label>
                    </div>
                </li>
                <?php } ?>
                <li class="nav-item dropdown">
                    <a class="nav-link btn btn-round" href="http://example.com/" id="planDropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        style="background-color: #67ceb9;color:#fff; border-color: #67ceb9; border-radius: 30px;">
                        Plan <span class="currentDate"></span> <i class="material-icons">keyboard_arrow_down</i>
                    </a>
                    <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="planDropdown">
                        <div class="dropdown-item">Current date&nbsp;&nbsp;&nbsp;
                            <div class="input-group">
                                <input type="date" class="form-control white-background current_date"
                                    name="current_date" value="" onchange="updateUserAccountDate('current_date')">
                            </div>
                        </div>
                        <div class="dropdown-item">Current balance&nbsp;&nbsp;&nbsp;
                            <span class="bmd-form-group">
                                <div class="input-group">
                                    <span class="input-group-addon" style="padding-top:9px;">
                                        <i class="material-icons">euro</i>
                                    </span>
                                    <input type="number" class="form-control white-background current_account_bal"
                                        name="current_account_bal" value=""
                                        onchange="updateUserAccountDate('current_account_bal')">
                            </span>
                        </div>
                    </div>
                    <div class="dropdown-item">Current Amazon saldo&nbsp;&nbsp;&nbsp;
                        <div class="input-group">
                            <span class="input-group-addon" style="padding-top:9px;">
                                <i class="material-icons">euro</i>
                            </span>
                            <input type="number" class="form-control white-background currentAmazonSaldo"
                                name="currentAmazonSaldo" value=""
                                onchange="updateUserAccountDate('currentAmazonSaldo')">
                        </div>
                    </div>
        </div>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ url('/user/profile') }}">
                <i class="fa fa-gear fa-spin" style="font-size:24px"></i>
                <p class="d-lg-none d-md-block">
                    Settings
                </p>
            </a>
        </li> --}}
        {{-- <li class="nav-item dropdown">
            <a class="nav-link" href="http://example.com/" id="navbarDropdownMenuLink" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="material-icons">notifications</i>
                <span class="notification">5</span>
                <p class="d-lg-none d-md-block">
                    Some Actions
                </p>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">Mike John responded to your email</a>
                        <a class="dropdown-item" href="#">You have 5 new tasks</a>
                        <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                        <a class="dropdown-item" href="#">Another Notification</a>
                        <a class="dropdown-item" href="#">Another One</a>
            </div>
        </li> --}}
        <li class="nav-item dropdown">
            <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="material-icons text-main">person</i>
                <p class="d-lg-none d-md-block">
                    Account
                </p>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                {{-- <a class="dropdown-item" href="#">Profile</a> --}}
                <a class="dropdown-item" href="#">Settings</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{url('/user/profile')}}">Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
        </ul>
    </div>
    </div>
</nav>
<!-- End Navbar -->
