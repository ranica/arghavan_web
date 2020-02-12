@can('menu_parking')
    <!-- Base Info Menu -->
    <li>
        <a data-toggle="collapse" href="#carInfoMenu">
            <i class="material-icons">image</i>
            <p>
            مدیریت خودرو
                <b class="caret"></b>
            </p>
        </a>

        <div class="collapse" id="carInfoMenu">
            <ul class="nav">
                 {{-- Capacity Parking --}}
                @can('car_capacity_parking')
                    <li>
                        <a href="{{ url('/carSites') }}">
                            <span class="sidebar-normal">
                              ثبت پارکینگ
                            </span>
                        </a>
                    </li>
                @endcan
                {{-- /Capacity Parking --}}


                {{-- Car management --}}
                @can('car_management_parking')
                    <li>
                        <a href="{{ url('/cars') }}">
                            <span class="sidebar-normal">
                                ثبت خودرو
                            </span>
                        </a>
                    </li>
                @endcan
                {{-- /Car management --}}



            </ul>
        </div>
    </li>
    <!-- Base Info Menu -->
@endcan
