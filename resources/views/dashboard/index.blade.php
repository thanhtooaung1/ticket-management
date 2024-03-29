<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard.header')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60"
                width="60">
        </div> --}}

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Ticket Support</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @if (Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a href="{{ route('user.create') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user-plus"></i>
                                    <p>
                                        Create User
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        User List
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>
                            <li>
                                <hr class="text-gray">
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('category.create') }}" class="nav-link">
                                    <i class="nav-icon fas fa-plus"></i>
                                    <p>
                                        Create Category
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('category.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-list"></i>
                                    <p>
                                        Category List
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>
                            <li>
                                <hr class="text-gray">
                            </li>


                            <li class="nav-item">
                                <a href="{{ route('label.create') }}" class="nav-link">
                                    <i class="nav-icon fas fa-tag"></i>
                                    <p>
                                        Create Label
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('label.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-tags"></i>
                                    <p>
                                        Label List
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>
                            <li>
                                <hr class="text-gray">
                            </li>
                        @endif

                        <li class="nav-item">
                            <a href="{{ route('ticket.create') }}" class="nav-link">
                                <i class="nav-icon fas fa-plus"></i>
                                <p>
                                    Create Ticket
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('ticket.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Tickets
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    @yield('content')
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @extends('dashboard.footer')
</body>

</html>
