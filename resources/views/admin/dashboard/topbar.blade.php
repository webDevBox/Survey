   <div class="topbar">
        <nav class="navbar-custom">
            <ul class="list-unstyled topbar-right-menu float-right mb-0">
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                        <img src="/images/{{Auth::guard('admin')->user()->logo }}" class="rounded-circle"> <span class="ml-1">{{ Auth::guard('admin')->user()->name }} <i class="mdi mdi-chevron-down"></i> </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h6 class="text-overflow m-0">Welcome !</h6>
                        </div>
                        <!-- item-->
                        <a href="{{ route('adminAccount') }}" class="dropdown-item notify-item">
                            <i class="fi-lock"></i> <span>Edit Profile</span>
                        </a>
                        <!-- item-->
                        <a href="{{ route('adminLogout') }}" class="dropdown-item notify-item"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                           <i class="fi-power"></i> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('adminLogout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                  </div>
                </li>
            </ul>
            <ul class="list-inline menu-left mb-0">
                <li class="float-left">
                    <button class="button-menu-mobile open-left disable-btn">
                        <i class="dripicons-menu"></i>
                    </button>
                </li>
                <li>
                    <div class="page-title-box">
                        <a href="{{ route('adminDashboard') }}">
                            <h4 class="page-title">Dashboard </h4>              
                        </a>
                        
                        <ol class="breadcrumb">
                            @yield('breadcrumb')
                            {{-- <li class="breadcrumb-item active">Welcome to Survery Form Admin Panel!</li> --}}
                        </ol>
                    </div>
                </li>

            </ul>

        </nav>

    </div>
    <!-- Top Bar End -->
