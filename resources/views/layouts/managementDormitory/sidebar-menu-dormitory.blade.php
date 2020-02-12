@can('menu_management_dormitory')
    <li class="active">
        <a data-toggle="collapse" href="#dormitoryMenu">
            <i class="fas fa-bed"></i>
            <p>
                مدیریت  خوابگاه و مهمانسرا
                <b class="caret"></b>
            </p>
        </a>

        @isRoot
            <div class="collapse" id="dormitoryMenu">
                <ul class="nav">
                    @can('building_infomation')
                        <li>
                            <a href="{{ url('/buildingInformations') }}">
                                <span class="sidebar-normal">
                                    تعریف خوابگاه
                                </span>
                            </a>
                        </li>
                    @endcan

                        <li>
                            <a href="#">
                                <span class="sidebar-normal">
                                    مدیریت خوابگاه
                                </span>
                            </a>
                        </li>
                </ul>
            </div>
        @endisRoot

    </li>
@endcan
