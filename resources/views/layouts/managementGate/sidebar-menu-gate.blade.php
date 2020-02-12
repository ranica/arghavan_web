 @can('menu_gate')
    <li>
        <a data-toggle="collapse" href="#gateManagementMenu">
            <i class="material-icons">widgets</i>
            <p>
                مديريت تردد
                <b class="caret"></b>
            </p>
        </a>
        <div class="collapse" id="gateManagementMenu">
            <ul class="nav">

                  <!-- Gate plan -->
                @can('gate_plan')
                    <li>
                        <a href="{{ url('/gatePlans') }}">
                            <span class="sidebar-normal">
                                برنامه تردد
                            </span>
                        </a>
                    </li>
                @endcan
                <!-- /Gate plan -->

                <!-- Zoon -->
                @can('gate_zone')
                    <li>
                        <a href="{{ url('/zones') }}">
                            <span class="sidebar-normal">
                                منطقه استقرار گیت
                            </span>
                        </a>
                    </li>
                @endcan
                <!-- /Zoon -->

                <!-- gate pass -->
                @can('gate_gatepass')
                    <li>
                        <a href="{{ url('/gatepasses') }}">
                            <span class="sidebar-normal">
                                نحوه عبور از گیت
                            </span>
                        </a>
                    </li>
                @endcan
                <!-- /gate pass -->

                <!-- Gate Device -->
                @can('gate_gate')
                    <li>
                        <a href="{{ url('/gatedevices') }}">
                            <span class="sidebar-normal">
                                گیت های ورود و خروج
                            </span>
                        </a>
                    </li>
                @endcan
                <!-- /Gate Device -->
            </ul>
        </div>
    </li>
@endcan

