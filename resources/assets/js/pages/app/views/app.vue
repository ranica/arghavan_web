<template>
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
                <router-link :to="{ name: 'home' }">Home</router-link>
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
                            </ul>
                        </div>
                    </div>
                </nav>

                <div class="content f-BYekan">
                    <div class="container-fluid">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- @yield('content') -->
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
</template>
<script type="text/javascript"></script>
