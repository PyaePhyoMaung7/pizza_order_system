<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('admin/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">
    @yield('style')
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="{{asset('admin/images/icon/logo.png')}}" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        {{-- <li class="active has-sub">
                            <a class="js-arrow" href="index.html">
                                <i class="fas fa-tachometer-alt"></i>Home Page
                            </a>
                        </li>
                        <li>
                            <a href="category.html">
                                <i class="fas fa-chart-bar"></i>Category</a>
                        </li>
                        <li>
                            <a href="customerList.html">
                                <i class="fas fa-chart-bar"></i>Customers</a>
                        </li> --}}
                        <li>
                            <a href="{{route('category#list')}}">
                                <i class="fa-solid fa-list"></i> Category</a>
                        </li>

                        <li>
                            <a href="{{route('product#list')}}">
                                <i class="fa-solid fa-pizza-slice"></i> Products</a>
                        </li>

                        <li>
                            <a href="{{route('order#list')}}">
                                <i class="fa-solid fa-clipboard-list fs-5"></i> Orders</a>
                        </li>

                        <li>
                            <a href="{{route('user#list')}}">
                                <i class="fa-solid fa-users fs-5"></i> Users</a>
                        </li>

                        <li>
                            <a href="{{route('admin#messageList')}}">
                                <i class="fa-solid fa-envelopes-bulk"></i> Messages</a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <span class="form-header">
                                <h3 class="px-3">Admin Panel</h3>
                            </span>
                            <div class="header-button">

                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu r">
                                        <div class="image d-flex align-items-center">
                                            @if (Auth::user()->image == null)
                                                @if (Auth::user()->gender == 'male')
                                                    <img src="{{ asset('image/default_male.jpg') }}" class="shadow" alt="">
                                                @else
                                                    <img src="{{ asset('image/default_female.webp') }}" class="shadow" alt="">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/'.Auth::user()->image) }}"
                                                    alt="{{ Auth::user()->name }}" />
                                            @endif
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{Auth::user()->name}}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image d-flex align-items-center">
                                                    <a href="#">
                                                        @if (Auth::user()->image == null)
                                                            @if (Auth::user()->gender == 'male')
                                                                <img src="{{ asset('image/default_male.jpg') }}" alt="">
                                                            @else
                                                                <img src="{{ asset('image/default_female.webp') }}" alt="">
                                                            @endif
                                                        @else
                                                            <img src="{{ asset('storage/'.Auth::user()->image) }}"
                                                                alt="{{ Auth::user()->name }}" />
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{Auth::user()->name}}</a>
                                                    </h5>
                                                    <span class="email">{{Auth::user()->email}}</span>
                                                </div>
                                            </div>

                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('admin#details')}}">
                                                        <i class="zmdi zmdi-account fs-3"></i>Account</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('admin#list')}}">
                                                        <i class="fa-solid fa-users"></i>Admin List</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('admin#changePasswordPage')}}">
                                                        <i class="fa-solid fa-key"></i>Change Password</a>
                                                </div>
                                            </div>

                                            <div class="account-dropdown__footer">
                                                <form action="{{route('logout')}}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn bg-dark text-white col-10 offset-1 my-3">
                                                        <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            @yield('content')
            <!-- END MAIN CONTENT-->

            <!-- END PAGE CONTAINER-->
        </div>
    </div>

    {{-- Font awesome JS --}}
    <script src="https://kit.fontawesome.com/f0ac7a1e41.js" crossorigin="anonymous"></script>
    <!-- Jquery JS-->
    <script src="{{ asset('admin/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="{{ asset('admin/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('admin/vendor/slick/slick.min.js') }}">
    </script>
    <script src="{{ asset('admin/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }}">
    </script>
    <script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/select2/select2.min.js') }}">
    </script>

    <!-- Main JS-->
    <script src="{{ asset('admin/js/main.js') }}"></script>

    {{-- jquery cdn  --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</body>
@yield('scriptSection')

</html>
<!-- end document-->
