<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <i class="bi bi-list toggle-sidebar-btn"></i>

    <div class="d-flex m-auto align-items-center justify-content-between">
        <a href="{{route('dashboard')}}" class="logo d-flex align-items-center">
            <img src="{{ asset('../../img/logo.png')}}" alt="">
            <span class="d-none d-lg-block">Nickel Mine</span>
        </a>
    </div><!-- End Logo -->

    <nav class="header-nav">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ asset('../../img/person.png')}}" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{$current_user->user_name}}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{$current_user->user_name}}</h6>
                        <span>{{$current_user->user_role}}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{route('logout')}}">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
