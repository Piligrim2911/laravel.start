<!DOCTYPE html>
<html lang="ru" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Панель управления сайтом">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Панель управления сайтом</title>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ secure_asset('/fonts/awesome/v5.15.4/css/all.css') }}">

    <!-- PLUGINS CSS STYLE -->
    <link href="{{ secure_asset('/plugins/nprogress/css/nprogress.css') }}" rel="stylesheet" />

    <!-- No Extra plugin used -->
    <link href="{{ secure_asset('/plugins/toastr/css/toastr.min.css') }}" rel="stylesheet" />

    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="{{ secure_asset('/templates/dashboard/' . config('settings.dashboard_theme') . '/css/sleek.min.css') }}" />
    <link rel="stylesheet" href="{{ secure_asset('/templates/dashboard/' . config('settings.dashboard_theme') . '/css/main.css') }}">

    <!-- FAVICON -->
    <link href="/templates/dashboard/sleek/images/favicon.png" rel="shortcut icon" />

    @yield('styles')
    <!--
        HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
    -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="{{ secure_asset('/plugins/nprogress/js/nprogress.js') }}"></script>
</head>
<body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">

    <script>
        NProgress.configure({ showSpinner: false });
        NProgress.start();
    </script>

    <div id="toaster"></div>

    <div class="wrapper">
        <aside class="left-sidebar bg-sidebar">
            <div id="sidebar" class="sidebar sidebar-with-footer">
                <!-- Aplication Brand -->
                <div class="app-brand">
                    <a href="/index.html" title="Sleek Dashboard">
                        <span class="brand-name text-truncate">Sleek Dashboard</span>
                    </a>
                </div>
                <!-- begin sidebar scrollbar -->
                <div class="sidebar-scrollbar">
                    <!-- sidebar menu -->
                    <ul class="nav sidebar-inner" id="sidebar-menu">
                        <li class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.index') }}" class="sidenav-item-link" >
                                <i class="mdi mdi-view-dashboard-outline"></i>
                                <span class="nav-text">Главная</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('dashboard.articles.index') ? 'active' : '' }}">
                            <a class="sidenav-item-link" href="{{ route('dashboard.articles.index') }}">
                                <i class="mdi mdi-pencil-box-multiple"></i>
                                <span class="nav-text">Статьи</span>
                            </a>
                        </li>
                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#menu1" aria-expanded="false" aria-controls="menu1">
                                <i class="mdi mdi-view-dashboard-outline"></i>
                                <span class="nav-text">Меню #1</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="menu1" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">Пункт меню #1</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="#">
                                            <span class="nav-text">Пункт меню #2</span>
                                            <span class="badge badge-success">new</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#menu2" aria-expanded="false" aria-controls="menu2">
                                <i class="mdi mdi-pencil-box-multiple"></i>
                                <span class="nav-text">Меню #2</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="menu2" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="chat.html">
                                            <span class="nav-text">Chat</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="contacts.html">
                                            <span class="nav-text">Contacts</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="team.html">
                                            <span class="nav-text">Team</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="calendar.html">
                                            <span class="nav-text">Calendar</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#components" aria-expanded="false" aria-controls="components">
                                <i class="mdi mdi-folder-multiple-outline"></i>
                                <span class="nav-text">Компоненты</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="components" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="alert.html">
                                            <span class="nav-text">Alert</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="badge.html">
                                            <span class="nav-text">Badge</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="breadcrumb.html">
                                            <span class="nav-text">Breadcrumb</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="button-default.html">
                                            <span class="nav-text">Button Default</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="button-dropdown.html">
                                            <span class="nav-text">Button Dropdown</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="button-group.html">
                                            <span class="nav-text">Button Group</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>

                {{--
                <div class="sidebar-footer">
                    <hr class="separator mb-0" />
                    <div class="sidebar-footer-content">
                        <h6 class="text-uppercase">
                            Cpu Uses <span class="float-right">40%</span>
                        </h6>
                        <div class="progress progress-xs">
                            <div class="progress-bar active" style="width: 40%;" role="progressbar"></div>
                        </div>
                        <h6 class="text-uppercase">
                            Memory Uses <span class="float-right">65%</span>
                        </h6>
                        <div class="progress progress-xs">
                            <div class="progress-bar progress-bar-warning" style="width: 65%;" role="progressbar"></div>
                        </div>
                    </div>
                </div>
                --}}
            </div>
        </aside>
        <div class="page-wrapper">
            <header class="main-header " id="header">
                <nav class="navbar navbar-static-top navbar-expand-lg pr-2">
                    <!-- Sidebar toggle button -->
                    <button id="sidebar-toggler" class="sidebar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                    </button>
                    <!-- search form -->
                    <div class="search-form d-none d-lg-inline-block">
                        <div class="input-group">
                            <button type="button" name="search" id="search-btn" class="btn btn-flat">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                            <input type="text" name="query" id="search-input" class="form-control" placeholder="'button', 'chart' etc." autofocus autocomplete="off" />
                        </div>
                        <div id="search-results-container">
                            <ul id="search-results"></ul>
                        </div>
                    </div>

                    <div class="navbar-right ">
                        <ul class="nav navbar-nav">
                            <li class="dropdown notifications-menu">
                                <button class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="mdi mdi-bell-outline"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-header">You have 5 notifications</li>
                                    <li>
                                        <a href="#">
                                            <i class="mdi mdi-account-plus"></i> New user registered
                                            <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 10 AM</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="mdi mdi-account-remove"></i> User deleted
                                            <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 07 AM</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="mdi mdi-chart-areaspline"></i> Sales report is ready
                                            <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 12 PM</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="mdi mdi-account-supervisor"></i> New client
                                            <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 10 AM</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="mdi mdi-server-network-off"></i> Server overloaded
                                            <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 05 AM</span>
                                        </a>
                                    </li>
                                    <li class="dropdown-footer">
                                        <a class="text-center" href="#"> View All </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- User Account -->
                            <li class="dropdown user-menu">
                                <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <img src="/templates/dashboard/sleek/images//user/user.png" class="user-image" alt="User Image" />
                                    <span class="d-none d-lg-inline-block">{{ $user->name }}</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right w-auto">
                                    <!-- User image -->
                                    <li class="dropdown-header">
                                        <img src="/templates/dashboard/sleek/images//user/user.png" class="img-circle" alt="User Image" />
                                        <div class="d-inline-block">
                                            {{ $user->name }} <small class="pt-1">{{ $user->email }}</small>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="user-profile.html">
                                            <i class="mdi mdi-account"></i> My Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="mdi mdi-email"></i> Message
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"> <i class="mdi mdi-diamond-stone"></i> Projects </a>
                                    </li>
                                    <li class="right-sidebar-in">
                                        <a href="javascript:0"> <i class="mdi mdi-settings"></i> Setting </a>
                                    </li>
                                    <li class="dropdown-footer">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="#"
                                               onclick="event.preventDefault(); this.closest('form').submit();">
                                                <i class="mdi mdi-logout"></i> Выйти
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <div class="content-wrapper">
                <div class="content">
                    @yield('content')
                </div>
            </div>

            <footer class="footer mt-auto">
                <div class="copyright bg-white">
                    <p>
                        &copy; <span id="copy-year">2019</span> Copyright Sleek Dashboard Bootstrap Template by
                        <a class="text-primary" href="https://izamax.local" target="_blank">IzaMAX</a>.
                    </p>
                </div>
                <script>
                    var d = new Date();
                    var year = d.getFullYear();
                    document.getElementById("copy-year").innerHTML = year;
                </script>
            </footer>
        </div>
    </div>

    <script src="{{ secure_asset('/plugins/jquery/jquery/v3.3.1/jquery.min.js') }}"></script>
    <script src="{{ secure_asset('/js/main.js') }}"></script>
    <script src="{{ secure_asset('/plugins/jquery/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ secure_asset('/plugins/jekyll-search/jekyll-search.min.js') }}"></script>
    <script src="{{ secure_asset('/plugins/moment/moment.js') }}"></script>
    <script src="{{ secure_asset('/plugins/toastr/js/toastr.min.js') }}"></script>
    <script src="{{ secure_asset('/templates/dashboard/' . config('settings.dashboard_theme') . '/js/sleek.bundle.js') }}"></script>
    @yield('scripts')
</body>
</html>
