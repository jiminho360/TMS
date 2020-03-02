<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title> TMS | @yield('title')</title>
    <!--Scripts-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <!-- Bootstrap -->
    <link href="{{asset('asset/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('asset/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

    <!-- DataTable -->
    <link href="{{asset('asset/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('asset/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('asset/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}"
          rel="stylesheet">
    <link href="{{asset('asset/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}"
          rel="stylesheet">
    <link href="{{asset('asset/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
    <!-- Site Theme Style -->
    <link href="{{asset('asset/build/css/site.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('asset/build/css/custom.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('asset/build/css/datepicker.css')}}" type="text/css">
    <!-- Sweet Alert CSS -->
    <link href="{{asset('asset/sweetAlert/sweetalert.css')}}" rel="stylesheet">
    <!-- Select 2 -->
    <link rel="stylesheet" href="{{asset('asset/vendors/select2/dist/css/select2.css')}}">
    <!-- NProgress -->
    <link href="{{asset('asset/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset('asset/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
    @yield('Styles')

</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{url('dashboard')}}" class="site_title"><i class="fa fa-book"></i>
                        <span>TMS</span></a>
                </div>
                <div class="clearfix"></div>
                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="/uploads/avatars/{{\Illuminate\Support\Facades\Auth::user()->avatar}}"
                             alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2>{{Auth::user()->first_name." ".Auth::user()->middle_name}}</h2>
                        {{--<span>{{" ".Auth::user()->usertype->name}}</span>--}}

                    </div>
                </div>
                <!-- /menu profile quick info -->
                <br/>
                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <ul class="nav side-menu">
                            @if(auth()->user()->hasRole('User'))
                                <li><a><i class="fa fa-dashboard"></i>Dashboard<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{'dashboard_tasksAssign'}}">Task Assign Dashboard</a></li>
                                        <li><a href="{{'dashboard_myTask'}}">My Task Dashboard</a></li>
                                    </ul>
                                </li>
                            @endif
                                @if(!auth()->user()->hasRole('User'))
                            <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
                            </li>
                                @endif
                            @if(auth()->user()->hasRole('User'))

                                <li><a><i class="fa fa-book"></i>Tasks<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a>My Tasks<span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu">
                                               {{-- <li class="sub_menu"><a href="{{url('User-Mytask')}}">All
                                                        Tasks</a>
                                                </li>--}}
                                                <li><a href="{{'NotCompleted'}}">Incomplete</a>
                                                </li>
                                                <li><a href="{{'Completed'}}">Complete</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a>Task Assign<span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu">
                                                <li class="sub_menu"><a href="{{url('User-task')}}">All Tasks</a>
                                                </li>
                                                <li><a href="{{'AllCompleted'}}">Complete</a>
                                                </li>
                                                <li><a href="{{'AllNotCompleted'}}">Incomplete</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-spinner"></i>Progress<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{url('User-progress')}}">Task Progress</a></li>
                                    </ul>
                                </li>
                            @endif
                            @if(auth()->user()->hasRole('Admin'))
                                <li><a><i class="fa fa-book"></i>Tasks<span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{url('employee-task')}}">Tasks Lists</a></li>
                                        <li><a href="{{url('Completed')}}">Complete</a></li>
                                        <li><a href="{{url('NotCompleted')}}">InComplete</a></li>
                                    </ul>
                                </li>
                            @endif
                            {{--@if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))--}}
                            @if(auth()->user()->hasRole('Admin'))
                                <div class="menu_section">
                                    <h3>General Settings</h3>
                                    <ul class="nav side-menu">
                                        <li><a><i class="fa fa-cog"></i> Settings <span
                                                    class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu">
                                                <li><a href="{{url('users')}}">Users</a></li>
                                                <li><a href="{{url('departments')}}">Department</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </ul>
                    </div>

                </div>
                <!-- /sidebar menu -->
                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    {{--<a data-toggle="tooltip" data-placement="top" title="Settings">--}}
                    {{--<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>--}}
                    {{--</a>--}}
                    {{--<a data-toggle="tooltip" data-placement="top" title="FullScreen">--}}
                    {{--<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>--}}
                    {{--</a>--}}
                    {{--<a data-toggle="tooltip" data-placement="top" title="Lock">--}}
                    {{--<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>--}}
                    {{--</a>--}}
                    <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{url('logout')}}">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle" style="color: white"><i class="fa fa-bars"></i></a>
                    </div>
                    <ul class="nav navbar-nav navbar-left">
                        <span class="pull-left" style="color: white;margin-top: 2.0vh; font-size: 20px">Task Management System(TMS)</span>
                    </ul>
                    <ul class="nav navbar-nav navbar-left pull-right">
                        <li class=" ">
                            <a style="color: white !important;" href="javascript:;" class="user-profile dropdown-toggle"
                               data-toggle="dropdown"
                               aria-expanded="false">
                                <img src="/uploads/avatars/{{\Illuminate\Support\Facades\Auth::user()->avatar}}"
                                     alt="User Image">{{Auth::user()->first_name." ".Auth::user()->middle_name}}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{url('profile')}}"> <i class="fa fa-user pull-right"></i>Profile</a></li>
                                <li><a href="{{url('ChangePassword')}}"><i class="fa fa-lock pull-right">
                                        </i>Change Password</a></li>
                                <li><a href="{{url('logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">

            @include('layouts.errors')
            @include('layouts.success')

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    @yield('content')
                </div>
            </div>
            <br/>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="{{asset('asset/vendors/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('asset/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<!-- DataTables -->
<script src="{{asset('asset/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('asset/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('asset/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('asset/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('asset/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('asset/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('asset/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('asset/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('asset/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('asset/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('asset/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
<script src="{{asset('asset/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
<script src="{{asset('asset/vendors/jszip/dist/jszip.min.js')}}"></script>
<script src="{{asset('asset/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{asset('asset/vendors/pdfmake/build/vfs_fonts.js')}}"></script>
<!-- NProgress -->
<script src="{{asset('asset/vendors/nprogress/nprogress.js')}}"></script>
<!-- bootstrap-progressbar -->
<script src="{{asset('asset/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>


<!-- Sweet Alert JS -->
<script src="{{asset('asset/sweetAlert/sweetalert2.min.js')}}"></script>
<!-- Site Theme Scripts -->
<script src="{{asset('asset/build/js/site.min.js')}}"></script>
<!--  Select 2   -->
<script src="{{asset('asset/vendors/select2/dist/js/select2.full.js')}}"></script>
<!-- Date Picker -->
<script src="{{asset('asset/build/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Custom JS -->
<script src="{{asset('asset/build/js/custom.js')}}"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function clearMsg() {
        $('.msg').hide();
    }

    $(window).load(function () {
        setTimeout(clearMsg, 3000);
    });
</script>


@yield('Scripts')
</body>
</html>
