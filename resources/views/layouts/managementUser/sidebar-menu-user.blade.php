  <!--  User Menu  -->
    @can('menu_user')
        <li>
            <a data-toggle="collapse" href="#userMenu">
                <i class="material-icons">content_paste</i>
                <p>
                    مدیریت کاربران
                    <b class="caret"></b>
                </p>
            </a>
            <div class="collapse" id="userMenu">
                <ul class="nav">

                    {{-- People --}}
                    @can('user_user')
                        <li>
                            <a href="{{ url('/people') }}">
                                <span class="sidebar-normal">
                                    ثبت کاربر
                                </span>
                            </a>
                        </li>
                    @endcan
                    {{-- /People --}}

                    {{-- Card --}}
                    @can('user_card')
                        <li>
                            <a href="{{ url('/cards') }}">
                                <span class="sidebar-normal">
                                    تخصیص کارت
                                </span>
                            </a>
                        </li>
                    @endcan
                    <!--  /Card  -->
                    <!-- Upload Image -->
                    @isRoot
                        @can('user_uploadImage')
                            <li>
                                <a href="{{ url('/uploadImage') }}">
                                    <span class="sidebar-normal">
                                        آپلود تصاویر
                                    </span>
                                </a>
                            </li>
                        @endcan
                    @endisRoot
                    <!-- Upload Image -->
                </ul>
            </div>
        </li>
    @endcan
    <!-- /User Menu  -->
