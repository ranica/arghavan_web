<!doctype html>

<html lang="en">

    <head>
        <meta charset="utf-8" />

        <title>{{ env('APP_NAME') }} - ورود</title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="O-BASE-URL" content="{{ url('/') }}" />

        <!--  Social tags      -->
        <meta name="keywords" content="Gate System">
        <meta name="description" content="Univertiy Gate System">

        <!-- Schema.org markup for Google+ -->
        <meta itemprop="name" content="Gate Software">
        <meta itemprop="description" content="Gate Software">

        <link href="{{ mix('css/fonts.css') }}" rel="stylesheet" />
        <link href="{{ mix('css/app.css') }}" rel="stylesheet" />
        <link href="{{ mix('css/misc.css') }}" rel="stylesheet" />
        <link href="{{ asset('theme/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('theme/css/material-dashboard.css') }}" rel="stylesheet" />
        <link href="{{ asset('theme/css/demo.css') }}" rel="stylesheet" />
    </head>

    <body class="off-canvas-sidebar f-BYekan">

        <div class="wrapper wrapper-full-page" id="app">
            <div class="full-page login-page" filter-color="black" data-image="{{ asset('images/login.jpeg') }}">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="footer hidden-sm hidden-md">
                    <div class="container">
                        <p class="copyright text-center">
                            &copy; {{ date('Y') }}
                            <a href="{{ url('/') }}">{{ env('APP_NAME') }}</a>
                        </p>
                    </div>
                </footer>
            </div>
        </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('theme/js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/jquery.sharrre.js') }}"></script>
    <script src="{{ asset('theme/js/jquery.tagsinput.js') }}"></script>
    <script src="{{ asset('theme/js/material.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/arrive.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/bootstrap-notify.js') }}"></script>
    <script src="{{ asset('theme/js/moment.min.js') }}"></script>
    <script src="{{ asset('theme/js/material-dashboard.js') }}"></script>
    <script src="{{ asset('theme/js/demo.js') }}"></script>

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ mix('js/additional.js') }}"></script>

    @yield('scripts')

    </body>
</html>
