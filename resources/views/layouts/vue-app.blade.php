<!DocType html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'>
    <meta name="viewport" content="width=device-width">
    <title>
        @yield('title')
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="O-BASE-URL" content="{{ url('/') }}" />
    <link rel="icon" type="image/png" href="{{ asset("theme/img/favicon.png") }}">
    <!-- Bootstrap core CSS     -->
    <link href="{{ asset("theme/css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("theme/css/bootstrap-rtl.css") }}" rel="stylesheet">
    <link href="{{ asset("theme/css/material-dashboard.css") }}" rel="stylesheet">
    {{-- <link href="{{ asset("theme/css/material-dashboard-lock.min.css") }}" rel="stylesheet"> --}}
    <link href="{{ asset("theme/css/demo.css") }}" rel="stylesheet">
    <link href="{{ asset("theme/css/datatables.css") }}" rel="stylesheet">
    <link href="{{ asset("theme/css/datatables.min.css") }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/chart.css') }}">
    <link rel="stylesheet" href="{{ mix("css/fonts.css") }}">

    <link rel="stylesheet" href="{{ mix('css/misc.css') }}">

    @yield('styles')
</head>

<body class="rtl-active f-BYekan">
   {{--  <div class="body-loading text-center">
        <h1 class="f-BYekan">
                بارگذاری اطلاعات
                @include('partials.loading')
            </h1>
    </div> --}}

    <div class="body-main-content hidden">
        <div class="wrapper">
            <div class="sidebar" data-active-color="rose" data-background-color="white" data-image="{{ asset("theme/img/sidebar-1.jpg") }}">
                <div class="logo">
                    <a href="#" class="simple-text logo-mini">
                        <i class="material-icons">group_work</i>
                    </a>
                    <a href="" class="simple-text logo-normal">
                    اتوماسیون هوشمند ارغوان
                    </a>
                </div>
                @include('layouts.sidebar')
            </div>
            <div class="main-panel">
                <nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute fixed-top">
                    <div class="container-fluid">
                        <div class="navbar-minimize">
                            <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                                <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                                <i class="material-icons visible-on-sidebar-mini">view_list</i>
                            </button>
                        </div>
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#"> TITLE </a>
                        </div>

                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                @can('dashboard_notification')
                                    <li>
                                        <a href="{{ route('vacation_managment') }}" >
                                            <i class="material-icons vacation-count">notifications</i>
                                            <span class="notification vacation-count"> {{ $vacationCount }} </span>
                                        </a>
                                    </li>
                                @endcan

                                {{-- @can('dashboard_notification') --}}
                                    <li>
                                        <a href="#" >
                                            <i class="fas fa-envelope-open fa-2x"></i>
                                            {{-- <i class="material-icons vacation-count">notifications</i> --}}
                                            <span class="notification vacation-count"> 0 </span>
                                        </a>
                                    </li>
                                {{-- @endcan --}}

                                @can('dashboard_dashboard')
                                    <li>
                                        <a href="{{ route('home') }}">
                                            <i class="material-icons"> dashboard</i> داشبورد من
                                        </a>
                                    </li>
                                @endcan

                                @can('dashboard_monitor')
                                    <li>
                                        <a href="{{ route('report_monitor_traffic') }}" >
                                            <i class="fa fa-desktop fa-2x"></i> مانیتورینگ تردد
                                        </a>
                                    </li>
                                @endcan

                                @can('dashboard_report')
                                    <li>
                                        <a href="{{ route('report_traffic') }}">
                                            <i class="fas fa-chart-pie fa-2x"></i> گزارش ورود و خروج
                                        </a>
                                    </li>
                                @endcan


                                @can('dashboard_sms')
                                    <li>
                                        <a href="{{ url('sms') }}">
                                            <i class="fa fa-comments"></i> ارسال پیامک
                                        </a>
                                    </li>
                                    <li class="separator hidden-lg hidden-md"></li>
                                @endcan
                            </ul>
                        </div>
                    </div>
                </nav>

                <div class="content f-BYekan">
                    <div class="container-fluid">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="footer">
                    <div class="container-fluid">
                        @yield('footer')
                    </div>
                </footer>
            </div>
        </div>

        <div class="fixed-plugin">
            <div class="dropdown show-dropdown">
                <a href="#" data-toggle="dropdown">
                    <i class="fa fa-cog fa-2x"> </i>
                </a>
                <ul class="dropdown-menu">
                    <li class="header-title">رنگ بندی</li>
                    <li class="adjustments-line">
                        <a href="javascript:void(0)" class="switch-trigger active-color">
                            <div class="badge-colors text-center">
                                <span class="badge filter badge-purple" data-color="purple">&nbsp;</span>
                                <span class="badge filter badge-blue" data-color="blue">&nbsp;</span>
                                <span class="badge filter badge-green" data-color="green">&nbsp;</span>
                                <span class="badge filter badge-orange" data-color="orange">&nbsp;</span>
                                <span class="badge filter badge-red" data-color="red">&nbsp;</span>
                                <span class="badge filter badge-rose active" data-color="rose">&nbsp;</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li class="header-title">رنگ پس زمینه</li>
                    <li class="adjustments-line">
                        <a href="javascript:void(0)" class="switch-trigger background-color">
                            <div class="text-center">
                                <span class="badge filter badge-white" data-color="white"></span>
                                <span class="badge filter badge-black active" data-color="black"></span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li class="adjustments-line">
                        <a href="javascript:void(0)" class="switch-trigger">
                            <p>سایدبار کوچک</p>
                            <div class="togglebutton switch-sidebar-mini">
                                <label>
                                    <input type="checkbox" unchecked="">
                                </label>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li class="adjustments-line">
                        <a href="javascript:void(0)" class="switch-trigger">
                            <p>تصویر پس زمینه</p>
                            <div class="togglebutton switch-sidebar-image">
                                <label>
                                    <input type="checkbox" checked="">
                                </label>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!--   Core JS Files   -->
        <script src="{{ asset ("theme/js/jquery-3.2.1.min.js") }}" type="text/javascript"></script>
        <script src="{{ asset ("theme/js/bootstrap.min.js") }}" type="text/javascript"></script>
        <script src="{{ asset ("theme/js/material.min.js") }}" type="text/javascript"></script>
        <script src="{{ asset ("theme/js/perfect-scrollbar.jquery.min.js") }}" type="text/javascript"></script>
        <!-- Library for adding dinamically elements -->
        <script src="{{ asset ("theme/js/arrive.min.js") }}" type="text/javascript"></script>
        <!-- Forms Validations Plugin -->
        <script src="{{ asset ("theme/js/jquery.validate.min.js") }}"></script>
        <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
        <script src="{{ asset ("theme/js/moment.min.js") }}"></script>
        <!--  Charts Plugin, full documentation here: https://gionkunz.github.io/chartist-js/ -->
        <script src="{{ asset ("theme/js/chartist.min.js") }}"></script>
        <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
        <script src="{{ asset ("theme/js/jquery.bootstrap-wizard.js") }}"></script>
        <!--  Notifications Plugin, full documentation here: http://bootstrap-notify.remabledesigns.com/    -->
        <script src="{{ asset ("theme/js/bootstrap-notify.js") }}"></script>
        <!--   Sharrre Library    -->
        <script src="{{ asset ("theme/js/jquery.sharrre.js") }}"></script>
        <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
        <script src="{{ asset ("theme/js/bootstrap-datetimepicker.js") }}"></script>
        <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
        <script src="{{ asset ("theme/js/jquery-jvectormap.js") }}"></script>
        <!-- Sliders Plugin, full documentation here: https://refreshless.com/nouislider/ -->
        <script src="{{ asset ("theme/js/nouislider.min.js") }}"></script>
        <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
        <script src="{{ asset ("theme/js/jquery.select-bootstrap.js") }}"></script>
        <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
        <script src="{{ asset ("theme/js/jquery.datatables.js") }}"></script>
        <script src="{{ asset ("theme/js/datatables.js") }}"></script>
        <script src="{{ asset ("theme/js/datatables.min.js") }}"></script>


        <!-- Sweet Alert 2 plugin, full documentation here: https://limonte.github.io/sweetalert2/ -->
        <script src="{{ asset ("theme/js/sweetalert2.js") }}"></script>
        <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
        <script src="{{ asset ("theme/js/jasny-bootstrap.min.js") }}"></script>
        <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
        <script src="{{ asset ("theme/js/fullcalendar.min.js") }}"></script>
        <!-- Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
        <script src="{{ asset ("theme/js/jquery.tagsinput.js") }}"></script>
        <!-- Material Dashboard javascript methods -->
        <script src="{{ asset ("theme/js/material-dashboard.js") }}"></script>
        <!-- Material Dashboard DEMO methods, don't include it in your project! -->
        <script src="{{ asset ("theme/js/demo.js") }}"></script>
        <script src="{{ asset ("theme/js/jquery.steps.js") }}"></script>

        <script type="text/javascript">
        $(document).ready(() => {
            // Disable card drop-off
            $('.card').off('mouseenter');
        });

        </script>

        <script src="{{ mix("js/app.js") }}"></script>
        <script src="{{ mix("js/additional.js") }}"></script>

        <script type="text/javascript">
        /**
         * Logout User
         */
        function logoutUser(event) {
            event.preventDefault();

            document.getElementById('logout-form')
                .submit();
        }

        $nav = $('.nav');
        if (null != $nav)
        {
            $navlike = $('.nav').find('a');
        }

        function updateNotifictaion(){
            setTimeout (() =>
            {
                axios.get('{{ route('notification.count_unreaded_vacation') }}')
                     .then (res => {
                            var p = $('span.vacation-count')[0];

                            p.innerText = res.data;

                        updateNotifictaion();
                    });
                }, 300000);
        };

        updateNotifictaion();
        </script>
        @yield('scripts')
    </div>
</body>

</html>
