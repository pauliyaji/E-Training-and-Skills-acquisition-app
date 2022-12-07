@include('layouts.header')

<div class="wrapper">
    <!-- Github Link -->
    <a href="https://github.com/tafcoder/sleek-dashboard"  target="_blank" class="github-link">
        <svg width="70" height="70" viewBox="0 0 250 250" aria-hidden="true">
            <defs>
                <linearGradient id="grad1" x1="0%" y1="75%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:#896def;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#482271;stop-opacity:1" />
                </linearGradient>
            </defs>
        </svg>
        <i class="mdi mdi-github-circle"></i>
    </a>

    <!--
  ====================================
  ——— LEFT SIDEBAR WITH FOOTER
  =====================================
-->
    <aside class="left-sidebar bg-sidebar">
        <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand">
                <a href="/index.html" title="Dashboard">
                    <g fill="none" fill-rule="evenodd">
                        <img src="{{ asset('/storage/images/'. Auth::user()->settings->first()->image) }}" width="250px" height="250px">
                     </g>
                </a>
            </div>
            <!-- begin sidebar scrollbar -->
            <div class="sidebar-scrollbar">

                <!-- sidebar menu -->
                <ul class="nav sidebar-inner" id="sidebar-menu">



                    <li class="nav-item active" style="background-color: rgba(226,249,237,0.93); margin: 10px;
                border-radius: 5px;">
                        <a class="nav-link" href="{{(url('dashboard'))}}" style="color: #024a04;">
                            <i class="fas fa-fw fa-tachometer-alt" style="color: #024a04;"></i>
                            <span>Dashboard</span></a>
                    </li>

                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#app"
                           aria-expanded="false" aria-controls="app">
                            <i class="mdi mdi-pencil-box-multiple"></i>
                            <span class="nav-text">App</span> <b class="caret"></b>
                        </a>
                        <ul  class="collapse"  id="app"
                             data-parent="#sidebar-menu">
                            <div class="sub-menu">



                                <li >
                                    <a class="sidenav-item-link" href="chat.html">
                                        <span class="nav-text">Chat</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="contacts.html">
                                        <span class="nav-text">Contacts</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="team.html">
                                        <span class="nav-text">Team</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="calendar.html">
                                        <span class="nav-text">Calendar</span>

                                    </a>
                                </li>




                            </div>
                        </ul>
                    </li>





                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#components"
                           aria-expanded="false" aria-controls="components">
                            <i class="mdi mdi-folder-multiple-outline"></i>
                            <span class="nav-text">Components</span> <b class="caret"></b>
                        </a>
                        <ul  class="collapse"  id="components"
                             data-parent="#sidebar-menu">
                            <div class="sub-menu">



                                <li >
                                    <a class="sidenav-item-link" href="alert.html">
                                        <span class="nav-text">Alert</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="badge.html">
                                        <span class="nav-text">Badge</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="breadcrumb.html">
                                        <span class="nav-text">Breadcrumb</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="button-default.html">
                                        <span class="nav-text">Button Default</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="button-dropdown.html">
                                        <span class="nav-text">Button Dropdown</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="button-group.html">
                                        <span class="nav-text">Button Group</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="button-social.html">
                                        <span class="nav-text">Button Social</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="button-loading.html">
                                        <span class="nav-text">Button Loading</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="card.html">
                                        <span class="nav-text">Card</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="carousel.html">
                                        <span class="nav-text">Carousel</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="collapse.html">
                                        <span class="nav-text">Collapse</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="list-group.html">
                                        <span class="nav-text">List Group</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="modal.html">
                                        <span class="nav-text">Modal</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="pagination.html">
                                        <span class="nav-text">Pagination</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="popover-tooltip.html">
                                        <span class="nav-text">Popover & Tooltip</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="progress-bar.html">
                                        <span class="nav-text">Progress Bar</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="spinner.html">
                                        <span class="nav-text">Spinner</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="switcher.html">
                                        <span class="nav-text">Switcher</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="tab.html">
                                        <span class="nav-text">Tab</span>

                                    </a>
                                </li>




                            </div>
                        </ul>
                    </li>





                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#icons"
                           aria-expanded="false" aria-controls="icons">
                            <i class="mdi mdi-diamond-stone"></i>
                            <span class="nav-text">Icons</span> <b class="caret"></b>
                        </a>
                        <ul  class="collapse"  id="icons"
                             data-parent="#sidebar-menu">
                            <div class="sub-menu">



                                <li >
                                    <a class="sidenav-item-link" href="material-icon.html">
                                        <span class="nav-text">Material Icon</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="flag-icon.html">
                                        <span class="nav-text">Flag Icon</span>

                                    </a>
                                </li>




                            </div>
                        </ul>
                    </li>





                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#forms"
                           aria-expanded="false" aria-controls="forms">
                            <i class="mdi mdi-email-mark-as-unread"></i>
                            <span class="nav-text">Forms</span> <b class="caret"></b>
                        </a>
                        <ul  class="collapse"  id="forms"
                             data-parent="#sidebar-menu">
                            <div class="sub-menu">



                                <li >
                                    <a class="sidenav-item-link" href="basic-input.html">
                                        <span class="nav-text">Basic Input</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="input-group.html">
                                        <span class="nav-text">Input Group</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="checkbox-radio.html">
                                        <span class="nav-text">Checkbox & Radio</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="form-validation.html">
                                        <span class="nav-text">Form Validation</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="form-advance.html">
                                        <span class="nav-text">Form Advance</span>

                                    </a>
                                </li>




                            </div>
                        </ul>
                    </li>





                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#tables"
                           aria-expanded="false" aria-controls="tables">
                            <i class="mdi mdi-table"></i>
                            <span class="nav-text">Tables</span> <b class="caret"></b>
                        </a>
                        <ul  class="collapse"  id="tables"
                             data-parent="#sidebar-menu">
                            <div class="sub-menu">



                                <li >
                                    <a class="sidenav-item-link" href="basic-tables.html">
                                        <span class="nav-text">Basic Tables</span>

                                    </a>
                                </li>





                                <li  class="has-sub" >
                                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#data-tables"
                                       aria-expanded="false" aria-controls="data-tables">
                                        <span class="nav-text">Data Tables</span> <b class="caret"></b>
                                    </a>
                                    <ul  class="collapse"  id="data-tables">
                                        <div class="sub-menu">

                                            <li >
                                                <a href="basic-data-table.html">Basic Data Table</a>
                                            </li>

                                            <li >
                                                <a href="responsive-data-table.html">Responsive Data Table</a>
                                            </li>

                                            <li >
                                                <a href="hoverable-data-table.html">Hoverable Data Table</a>
                                            </li>

                                            <li >
                                                <a href="expendable-data-table.html">Expendable Data Table</a>
                                            </li>

                                        </div>
                                    </ul>
                                </li>



                            </div>
                        </ul>
                    </li>





                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#maps"
                           aria-expanded="false" aria-controls="maps">
                            <i class="mdi mdi-google-maps"></i>
                            <span class="nav-text">Maps</span> <b class="caret"></b>
                        </a>
                        <ul  class="collapse"  id="maps"
                             data-parent="#sidebar-menu">
                            <div class="sub-menu">



                                <li >
                                    <a class="sidenav-item-link" href="google-map.html">
                                        <span class="nav-text">Google Map</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="vector-map.html">
                                        <span class="nav-text">Vector Map</span>

                                    </a>
                                </li>




                            </div>
                        </ul>
                    </li>





                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#widgets"
                           aria-expanded="false" aria-controls="widgets">
                            <i class="mdi mdi-widgets"></i>
                            <span class="nav-text">Widgets</span> <b class="caret"></b>
                        </a>
                        <ul  class="collapse"  id="widgets"
                             data-parent="#sidebar-menu">
                            <div class="sub-menu">



                                <li >
                                    <a class="sidenav-item-link" href="general-widget.html">
                                        <span class="nav-text">General Widget</span>

                                    </a>
                                </li>



                                <li >
                                    <a class="sidenav-item-link" href="chart-widget.html">
                                        <span class="nav-text">Chart Widget</span>

                                    </a>
                                </li>




                            </div>
                        </ul>
                    </li>





                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#charts"
                           aria-expanded="false" aria-controls="charts">
                            <i class="mdi mdi-chart-pie"></i>
                            <span class="nav-text">Charts</span> <b class="caret"></b>
                        </a>
                        <ul  class="collapse"  id="charts"
                             data-parent="#sidebar-menu">
                            <div class="sub-menu">



                                <li >
                                    <a class="sidenav-item-link" href="chartjs.html">
                                        <span class="nav-text">ChartJS</span>

                                    </a>
                                </li>




                            </div>
                        </ul>
                    </li>





                    <li  class="has-sub active expand" >
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#pages"
                           aria-expanded="false" aria-controls="pages">
                            <i class="mdi mdi-image-filter-none"></i>
                            <span class="nav-text">Pages</span> <b class="caret"></b>
                        </a>
                        <ul  class="collapse show"  id="pages"
                             data-parent="#sidebar-menu">
                            <div class="sub-menu">



                                <li  class="active" >
                                    <a class="sidenav-item-link" href="user-profile.html">
                                        <span class="nav-text">User Profile</span>

                                    </a>
                                </li>





                                <li  class="has-sub" >
                                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#authentication"
                                       aria-expanded="false" aria-controls="authentication">
                                        <span class="nav-text">Authentication</span> <b class="caret"></b>
                                    </a>
                                    <ul  class="collapse"  id="authentication">
                                        <div class="sub-menu">

                                            <li >
                                                <a href="sign-in.html">Sign In</a>
                                            </li>

                                            <li >
                                                <a href="sign-up.html">Sign Up</a>
                                            </li>

                                        </div>
                                    </ul>
                                </li>




                                <li  class="has-sub" >
                                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#others"
                                       aria-expanded="false" aria-controls="others">
                                        <span class="nav-text">Others</span> <b class="caret"></b>
                                    </a>
                                    <ul  class="collapse"  id="others">
                                        <div class="sub-menu">

                                            <li >
                                                <a href="invoice.html">Invoice</a>
                                            </li>

                                            <li >
                                                <a href="404.html">404 Page</a>
                                            </li>

                                        </div>
                                    </ul>
                                </li>



                            </div>
                        </ul>
                    </li>





                    <li  class="has-sub" >
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#documentation"
                           aria-expanded="false" aria-controls="documentation">
                            <i class="mdi mdi-book-open-page-variant"></i>
                            <span class="nav-text">Documentation</span> <b class="caret"></b>
                        </a>
                        <ul  class="collapse"  id="documentation"
                             data-parent="#sidebar-menu">
                            <div class="sub-menu">



                                <li class="section-title">
                                    Getting Started
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="introduction.html">
                                        <span class="nav-text">Introduction</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="quick-start.html">
                                        <span class="nav-text">Quick Start</span>

                                    </a>
                                </li>






                                <li >
                                    <a class="sidenav-item-link" href="customization.html">
                                        <span class="nav-text">Customization</span>

                                    </a>
                                </li>






                                <li class="section-title">
                                    Layouts
                                </li>





                                <li  class="has-sub" >
                                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#headers"
                                       aria-expanded="false" aria-controls="headers">
                                        <span class="nav-text">Header Variations</span> <b class="caret"></b>
                                    </a>
                                    <ul  class="collapse"  id="headers">
                                        <div class="sub-menu">

                                            <li >
                                                <a href="header-fixed.html">Header Fixed</a>
                                            </li>

                                            <li >
                                                <a href="header-static.html">Header Static</a>
                                            </li>

                                            <li >
                                                <a href="header-light.html">Header Light</a>
                                            </li>

                                            <li >
                                                <a href="header-dark.html">Header Dark</a>
                                            </li>

                                        </div>
                                    </ul>
                                </li>




                                <li  class="has-sub" >
                                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#sidebar-navs"
                                       aria-expanded="false" aria-controls="sidebar-navs">
                                        <span class="nav-text">Sidebar Variations</span> <b class="caret"></b>
                                    </a>
                                    <ul  class="collapse"  id="sidebar-navs">
                                        <div class="sub-menu">

                                            <li >
                                                <a href="sidebar-fixed-default.html">Sidebar Fixed Default</a>
                                            </li>

                                            <li >
                                                <a href="sidebar-fixed-minified.html">Sidebar Fixed Minified</a>
                                            </li>

                                            <li >
                                                <a href="sidebar-fixed-offcanvas.html">Sidebar Fixed Offcanvas</a>
                                            </li>

                                            <li >
                                                <a href="sidebar-static-default.html">Sidebar Static Default</a>
                                            </li>

                                            <li >
                                                <a href="sidebar-static-minified.html">Sidebar Static Minified</a>
                                            </li>

                                            <li >
                                                <a href="sidebar-static-offcanvas.html">Sidebar Static Offcanvas</a>
                                            </li>

                                            <li >
                                                <a href="sidebar-with-footer.html">Sidebar With Footer</a>
                                            </li>

                                            <li >
                                                <a href="sidebar-without-footer.html">Sidebar Without Footer</a>
                                            </li>

                                            <li >
                                                <a href="right-sidebar.html">Right Sidebar</a>
                                            </li>

                                        </div>
                                    </ul>
                                </li>





                                <li >
                                    <a class="sidenav-item-link" href="rtl.html">
                                        <span class="nav-text">RTL Direction</span>

                                    </a>
                                </li>




                            </div>
                        </ul>
                    </li>



                </ul>

            </div>

            <div class="sidebar-footer">
                <hr class="separator mb-0" />
                <div class="sidebar-footer-content">
                    <h6 class="text-uppercase">
                        Cpu Uses <span class="float-right">40%</span>
                    </h6>
                    <div class="progress progress-xs">
                        <div
                            class="progress-bar active"
                            style="width: 40%;"
                            role="progressbar"
                        ></div>
                    </div>
                    <h6 class="text-uppercase">
                        Memory Uses <span class="float-right">65%</span>
                    </h6>
                    <div class="progress progress-xs">
                        <div
                            class="progress-bar progress-bar-warning"
                            style="width: 65%;"
                            role="progressbar"
                        ></div>
                    </div>
                </div>
            </div>
        </div>
    </aside>


    <div class="page-wrapper">
        <!-- Header -->
        <header class="main-header " id="header">
            <nav class="navbar navbar-static-top navbar-expand-lg">
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
                        <input type="text" name="query" id="search-input" class="form-control" placeholder="'button', 'chart' etc."
                               autofocus autocomplete="off" />
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
                        <li class="right-sidebar-in right-sidebar-2-menu">
                            <i class="mdi mdi-settings mdi-spin"></i>
                        </li>
                        <!-- User Account -->
                        <li class="dropdown user-menu">
                            <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <img src="{{ asset('/assets/img/user/user.png') }}" class="user-image" alt="User Image" />
                                <span class="d-none d-lg-inline-block">Abdus Salam</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <!-- User image -->
                                <li class="dropdown-header">
                                    <img src="{{ asset('assets/img/user/user.png') }}" class="img-circle" alt="User Image" />
                                    <div class="d-inline-block">
                                        Abdus Salam <small class="pt-1">iamabdus@gmail.com</small>
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
                                    <a href="index.html"> <i class="mdi mdi-logout"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>


        </header>


        <div class="content-wrapper">
            {{--MAIN CONTENT GOES HERE--}}
            @yield('content')

            <div class="right-sidebar-2">
                <div class="right-sidebar-container-2">
                    <div class="slim-scroll-right-sidebar-2">

                        <div class="right-sidebar-2-header">
                            <h2>Layout Settings</h2>
                            <p>User Interface Settings</p>
                            <div class="btn-close-right-sidebar-2">
                                <i class="mdi mdi-window-close"></i>
                            </div>
                        </div>

                        <div class="right-sidebar-2-body">
                            <span class="right-sidebar-2-subtitle">Header Layout</span>
                            <div class="no-col-space">
                                <a href="javascript:void(0);" class="btn-right-sidebar-2 header-fixed-to btn-right-sidebar-2-active">Fixed</a>
                                <a href="javascript:void(0);" class="btn-right-sidebar-2 header-static-to">Static</a>
                            </div>

                            <span class="right-sidebar-2-subtitle">Sidebar Layout</span>
                            <div class="no-col-space">
                                <select class="right-sidebar-2-select" id="sidebar-option-select">
                                    <option value="sidebar-fixed">Fixed Default</option>
                                    <option value="sidebar-fixed-minified">Fixed Minified</option>
                                    <option value="sidebar-fixed-offcanvas">Fixed Offcanvas</option>
                                    <option value="sidebar-static">Static Default</option>
                                    <option value="sidebar-static-minified">Static Minified</option>
                                    <option value="sidebar-static-offcanvas">Static Offcanvas</option>
                                </select>
                            </div>

                            <span class="right-sidebar-2-subtitle">Header Background</span>
                            <div class="no-col-space">
                                <a href="javascript:void(0);" class="btn-right-sidebar-2 btn-right-sidebar-2-active header-light-to">Light</a>
                                <a href="javascript:void(0);" class="btn-right-sidebar-2 header-dark-to">Dark</a>
                            </div>

                            <span class="right-sidebar-2-subtitle">Navigation Background</span>
                            <div class="no-col-space">
                                <a href="javascript:void(0);" class="btn-right-sidebar-2 btn-right-sidebar-2-active sidebar-dark-to">Dark</a>
                                <a href="javascript:void(0);" class="btn-right-sidebar-2 sidebar-light-to">Light</a>
                            </div>

                            <span class="right-sidebar-2-subtitle">Direction</span>
                            <div class="no-col-space">
                                <a href="javascript:void(0);" class="btn-right-sidebar-2 btn-right-sidebar-2-active ltr-to">LTR</a>
                                <a href="javascript:void(0);" class="btn-right-sidebar-2 rtl-to">RTL</a>
                            </div>

                            <div class="d-flex justify-content-center" style="padding-top: 30px">
                                <div id="reset-options" style="width: auto; cursor: pointer" class="btn-right-sidebar-2 btn-reset">Reset
                                    Settings</div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>

@include('layouts.footer2')
