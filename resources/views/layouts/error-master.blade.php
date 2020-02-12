<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Material Dashboard PRO by Creative Tim
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- CSS Files -->
  <link href="{{ asset("theme/css/bootstrap.min.css") }}" rel="stylesheet">
  <link href="{{ asset("theme/css/bootstrap-rtl.css") }}" rel="stylesheet">
  <link href="{{ asset("theme/css/material-dashboard-lock.min.css") }}" rel="stylesheet">
  <link href="{{ asset("theme/css/demo.css") }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ mix("css/fonts.css") }}">
  <link rel="stylesheet" type="text/css" href="{{ mix('css/pages/lock.css') }}">
</head>

<body class="off-canvas-sidebar">
  <!-- Extra details for Live View on GitHub Pages -->

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
    <div class="container">
      <div class="navbar-wrapper">
        <a class="navbar-brand" href="#pablo">صفحه خطا</a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">

        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="wrapper wrapper-full-page">
    <div class="page-header error-page header-filter" style="background-image: url( {{ asset('/images/error.jpeg') }})">
      <!--   you can change the color of the filter page using: data-color="blue | green | orange | red | purple" -->
      <div class="content-center">
        <div class="row">
            <div class="col-md-12">
              <h1 class="title">404</h1>
              <h2>صفحه مورد نظر یافت نشد</h2>

              <div>
                 @auth
                    <a href="{{ route('home') }}" class="btn btn-primary btn-round">
                      <i class="material-icons md-48">dashboard</i> داشبورد من
                    </a>
                  @else
                      <a href="{{ route('login') }}" class="btn btn-primary btn-round">
                        <i class="material-icons md-48">fingerprint</i> ورود به سامانه
                      </a>
                  @endauth
              </div>
            </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container">
          <!--   <nav class="float-left">
                <ul>
                  <li>
                    <a href="https://www.creative-tim.com">
                      Creative Tim
                    </a>
                  </li>
                  <li>
                    <a href="https://creative-tim.com/presentation">
                      About Us
                    </a>
                  </li>
                  <li>
                    <a href="http://blog.creative-tim.com">
                      Blog
                    </a>
                  </li>
                  <li>
                    <a href="https://www.creative-tim.com/license">
                      Licenses
                    </a>
                  </li>
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
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      // md.checkFullPageBackgroundImage();
    });
  </script>
</body>

</html>
