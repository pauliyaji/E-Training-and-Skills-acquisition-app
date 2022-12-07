<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Skills Acquisition - Dashboard</title>


<!-- Custom fonts for this template-->
    <link href="{{ asset('/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://use.typekit.net/ozk1mll.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css" />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('/css/sb-admin-2.min.css') }}" rel="stylesheet">    <!-- JavaScript Bundle with Popper -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>


</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <li class="nav-item active mt-3 mb-1" style="margin-left: 10px; margin-right: 10px; margin-top: 5px;">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{('dashboard') }}">

            <div class="sidebar-brand-icon mt-5 pt-2">

            </div>
            <div class="sidebar-brand-text mx-3">
                @if((Auth::user()->setting_id))
                    <img src="{{ asset('/storage/images/'. Auth::user()->settings->first()->image) }}" width="100%">
                    <h6 style="font-weigth: bold; font-size: 10px;">{{ Auth::user()->settings->first()->institution }}</h6>
                @endif
            </div>
        </a>
        </li>
        <br/><br/>
        <!-- Nav Item - Dashboard -->

        <li class="nav-item active">
            <a class="nav-link" href="{{ route('dashboard') }}">
                {{--<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-200"></i>--}}
                Dashboard
            </a>
        </li>
        @if(Auth::user()->roles->first()->id == 1 or Auth::user()->roles->first()->id == 4)

            <li class="nav-item">
                <a class="nav-link @if(!request()->is('admin/staff*')) collapsed @endif" href="#" data-toggle="collapse"
                   data-target="#collapseBatch" aria-expanded="true" aria-controls="collapseTwo">
                    {{--<i class="fas fa-fw fa-table"></i>--}}
                    Mentees
                </a>
                <div id="collapseBatch" class="collapse @if(request()->is('admin/staff*')) show @endif"
                     aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner rounded" style="background-color: rgba(226,249,237,0.93); margin: 10px;
                border-radius: 5px;">
                        <a class="collapse-item" href="{{ route('students.index') }}">All Mentees</a>
                        <a class="collapse-item" href="{{ route('batches.index') }}">All Batches</a>
                        <a class="collapse-item" href="{{ route('classes.index') }}">All Classes</a>
                        <a class="collapse-item" href="{{ route('attendance.create') }}">Take Attendance</a>
                        <a class="collapse-item" href="{{ route('attendance.index') }}">General Attendance</a>

                    </div>
                </div>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('mentors.index') }}">
                    {{--<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-200"></i>--}}
                    Mentors
                </a>
            </li>
        @endif

         @if(Auth::user()->roles->first()->id == 1 or Auth::user()->roles->first()->id == 4)
            <li class="nav-item">
                <a class="nav-link items-center @if(!request()->is('admin/staff*')) collapsed @endif" href="#" data-toggle="collapse"
                   data-target="#collapseMgt" aria-expanded="true" aria-controls="collapseTwo">
                    {{--<i class="fas fa-fw fa-table"></i>--}}
                    Post Training Mgt.
                </a>

                <div id="collapseMgt" class="collapse @if(request()->is('admin/staff*')) show @endif"
                     aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner rounded" style="background-color: rgba(226,249,237,0.93); margin: 10px;
                border-radius: 5px;">
                        <a class="collapse-item" href="{{ route('starters.index') }}">Starter Packs</a>
                    </div>
                </div>
            </li>
            @endif
        @if(Auth::user()->roles->first()->id == 5)
            <li class="nav-item active">
                <a class="nav-link items-center" href="{{ route('mentorships.mymentees') }}">
                    My Mentees
                </a>
            </li>
        @endif
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('users.profile', Auth::user()->id) }}">
                My Profile
            </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link items-center" href="{{ route('feedbacks.myfeedback') }}">
                {{--<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-200"></i>--}}
                My Feedback
            </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link items-center" href="{{ route('messages.index') }}">
                {{--<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-200"></i>--}}
                Messages
            </a>
        </li>

        @if(Auth::user()->roles->first()->id == 1 or Auth::user()->roles->first()->id == 4)

        <li class="nav-item">
                <a class="nav-link @if(!request()->is('admin/staff*')) collapsed @endif" href="#" data-toggle="collapse"
                   data-target="#collapseStaff" aria-expanded="true" aria-controls="collapseTwo">
                    {{--<i class="fas fa-fw fa-table"></i>--}}
                    Admin
                </a>
                <div id="collapseStaff" class="collapse @if(request()->is('admin/staff*')) show @endif"
                     aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner rounded" style="background-color: rgba(226,249,237,0.93); margin: 10px;
                border-radius: 5px;">
                        <a class="collapse-item" href="{{ route('courses.index') }}">All Courses</a>
                        <a class="collapse-item" href="{{ route('subjects.index') }}">All Subjects</a>
                        <a class="collapse-item" href="{{ route('lgas.index') }}">All LGAs/Departments</a>
                        <a class="collapse-item" href="{{ route('categories.index') }}">All Categories</a>
                        <a class="collapse-item" href="{{ route('locations.index') }}">All Center Loctions</a>
                        <a class="collapse-item" href="{{ route('users.index') }}">View All Users</a>
                        <a class="collapse-item" href="{{ route('roles.index') }}">View Roles</a>
                        <a class="collapse-item" href="{{ route('permissions.index') }}">View Permissions</a>

                    </div>
                </div>
            </li>
        @endif

    <!-- STAFF MASTERS  -->

        @if(Auth::user()->roles->first()->id == 1)

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('settings.index') }}">
                    {{--<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-200"></i>--}}
                    Settings
                </a>
            </li>
        @endif

        <!-- LOGOUT -->
        <li class="nav-item active">

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="nav-link" href="{{route('logout')}}" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw text-gray-200"></i>
                    Logout
                </a>

            </form>

        </li>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content" style="background-color: rgba(226,249,237,0.93);">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>
             <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter">3+</span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Alerts Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 12, 2019</div>
                                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-success">
                                        <i class="fas fa-donate text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 7, 2019</div>
                                    $290.29 has been deposited into your account!
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-warning">
                                        <i class="fas fa-exclamation-triangle text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 2, 2019</div>
                                    Spending Alert: We've noticed unusually high spending for your account.
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }} <p style="color: #908e8e;">{{ Auth::user()->roles->first()->name }}</p></span>
                            <img class="img-profile rounded-circle" src="{{ asset('../storage/app/public/imgs/'. Auth::user()->photo) }}" height="60" width="60">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('users.profile', Auth::user()->id) }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a class="dropdown-item" href="route('logout')" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>

                            </form>

                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->

                @if(Session::has('success'))
                <div class="card" style="padding: 10px; margin: 10px;" >
                    <h4 class="text-success">{{ Session('success') }}</h4>

                @elseif(Session::has('error'))
                <div class="card" style="padding: 10px; margin: 10px;" >
                <h4 class="text-danger">{{ Session('error') }}</h4>
                </div>
                @endif


          @yield('content')
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <p style="font-weight: bold;">{{ Auth::user()->settings->first()->address }}</p>
                    <span>Copyright &copy; <script>document.write(new Date().getFullYear())</script> Gombe Trainings</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a class="btn btn-primary" :href="route('logout')"
                                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>

    </div>
</div>

@yield('scripts')

</body>

</html>
<?php
/**
 * Created by PhpStorm.
 * User: Paul-Iyaji
 * Date: 10/8/2021
 * Time: 5:46 AM
 */
