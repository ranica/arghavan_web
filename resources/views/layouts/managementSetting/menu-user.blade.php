
@can('menu_auth')
    <li>
        <a data-toggle="collapse" href="#permissionMenu">
            <i class="material-icons">assignment_ind</i>
            <p>
                تنظیمات سیستم
                <b class="caret"></b>
            </p>
        </a>
        <div class="collapse" id="permissionMenu">
            <ul class="nav">
                {{-- Permission --}}
                @isRoot
                   
                    @can('auth_permission')
                        <li>
                            <a href="{{ url('/permissions') }}">
                                <span class="sidebar-normal">
                                    مجوز ها
                                </span>
                            </a>
                        </li>
                    @endcan
                    
                @endisRoot
                {{--/ Permission --}}

                {{-- Role --}}
                @can('auth_role')
                    <li>
                        <a href="{{ url('/roles') }}">
                            <span class="sidebar-normal">
                                نقش کاربران
                            </span>
                        </a>
                    </li>
                @endcan
                {{-- /Role --}}

                {{-- Group_Permit --}}
                @can('auth_group')
                    <li>
                        <a href="{{ url('/grouppermits') }}">
                            <span class="sidebar-normal">
                                گروه های دسترسی
                            </span>
                        </a>
                    </li>
                @endcan
                {{-- /Group_permit --}}
            </ul>
        </div>
    </li>
@endcan
