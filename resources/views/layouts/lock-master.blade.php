<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>{{ env('APP_NAME') }} - صفحه قفل</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="O-BASE-URL" content="{{ url('/') }}" />

  <!-- CSS Files -->
  <link href="{{ asset("theme/css/bootstrap.min.css") }}" rel="stylesheet">
  <link href="{{ asset("theme/css/bootstrap-rtl.css") }}" rel="stylesheet">
  <link href="{{ asset("theme/css/material-dashboard-lock.min.css") }}" rel="stylesheet">
  <link href="{{ asset("theme/css/demo.css") }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ mix("css/fonts.css") }}">
  <link rel="stylesheet" type="text/css" href="{{ mix('css/pages/lock.css') }}">

</head>

    <body class="off-canvas-sidebar f-BYekan">
      <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
          <div class="container">
            <div class="navbar-wrapper">
              <a class="navbar-brand" href="#pablo">صفحه قفل</a>
            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
              <span class="sr-only">Toggle navigation</span>
              <span class="navbar-toggler-icon icon-bar"></span>
              <span class="navbar-toggler-icon icon-bar"></span>
              <span class="navbar-toggler-icon icon-bar"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end">
              <ul class="navbar-nav">
                <li class="nav-item ">
                  <a href="../pages/login.html" class="nav-link">
                    <i class="material-icons">fingerprint</i>  ورود به سامانه
                  </a>
                </li>
                <li class="nav-item  active ">
                  <a href="../pages/lock.html" class="nav-link">
                    <i class="material-icons">lock_open</i> قفل سامانه
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->

        <div class="wrapper wrapper-full-page">
          <div class="page-header lock-page header-filter" style="background-image: url({{  asset ('images/lock.jpeg')  }})">
            <!--   you can change the color of the filter page using: data-color="blue | green | orange | red | purple" -->
            <div class="container">
              <div class="row">
                <div class="col-md-4 ml-auto mr-auto">
                 @yield('content')
                </div>
              </div>
            </div>
            <footer class="footer">
              <div class="container">
                <!-- <nav class="float-left">
                  <ul>
                    <li>
                      <a href="https://www.creative-tim.com">
                        Creative Tim
                      </a>
                    </li>
                    <li>
                      <a href="https://www.ipass-co.ir">
                        درباره ما
                      </a>
                    </li>
                    <li>
                      <a href="http://blog.creative-tim.com">
                        Blog
                      </a>
                    </li>
                 /
                  </ul>
                </nav> -->
                <div class="copyright float-center">
                  <h4>
                      <p class="text-center">
                          &copy; {{ date('Y') }}
                          {{ env('APP_NAME') }}
                      </p>
                    کلیه حقوق مادی و معنوی این سایت متعلق به
                          <a href="https://www.ipass-co.ir"> شرکت سامان افزار اندیش افق</a>
                      می باشد
                  </h4>
                </div>
              </div>
            </footer>
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
        <!-- <script src="../../assets/demo/jquery.sharrre.js"></script> -->

      <script>
    $(document).ready(function() {
      //md.checkFullPageBackgroundImage();
      setTimeout(function() {
        // after 1000 ms we add the class animated to the login/register card
        $('.card').removeClass('card-hidden');
      }, 700);
    });
  </script>
  <script src="{{ mix('js/app.js') }}"></script>
  <script src="{{ mix('js/additional.js') }}"></script>
   @yield('scripts')
</body>

</html>
