    <div class="sidebar" data-color="rose" data-background-color="black"
        data-image="{{ asset('media/admin/img/sidebar-1.jpg') }}">
        <!--
                                        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

                                        Tip 2: you can also add an image using data-image tag
                                    -->
        <div class="logo"><a href="{{ url('/home') }}" class="simple-text logo-mini"> </a>
            <a href="{{ url('/home') }}" class="simple-text logo-normal title-name">
                CF Master
            </a>
        </div>
        <div class="sidebar-wrapper">
            <div class="user">
                <div class="photo">
                    <img class="user_img" src="{{ Auth::user()->photo ? Auth::user()->photo : 'https://ui-avatars.com/api/?name='.Auth::user()->name.'&color=7F9CF5&background=EBF4FF'}}" />
                </div>
                <div class="user-info">
                    <a  href="{{url('/user/profile')}}" class="username">
                        <span>
                            {{ Auth::user()->name }}
                        </span>
                    </a>
                </div>
            </div>
            <ul class="nav">
                <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
                    <a class="nav-link " href="{{ url('/home') }}">
                        <i class="material-icons">dashboard</i>
                        <p> Dashboard </p>
                    </a>
                </li>
                <li class="nav-item  {{ request()->is('runningCost') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/runningCost') }}">
                        <i class="material-icons">insights</i>
                        <p> Running Cost </p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('products') ? 'active' : '' }}">
                    <a class="nav-link " href="{{ url('/products') }}">
                        <i class="material-icons">category</i>
                        <p> Products </p>
                    </a>
                </li>
            </ul>
        </div>
        <div class="sidebar-background"></div>
    </div>
