@can('menu_parking')

    <li class="active">
        <a data-toggle="collapse" href="#parkingInformationMenu">
            <i class="material-icons">directions_car</i>
            <p>
                مدیریت پارکینگ
                <b class="caret"></b>
            </p>
        </a>

        <div class="collapse" id="parkingInformationMenu">
            <ul class="nav">

                 {{-- Capacity Parking --}}
                   {{--  @can('car_capacity_parking')
                        <li>
                            <a href= "{{ route('car_base') }}">
                                <span class="sidebar-normal">
                                    اطلاعات پایه
                                </span>
                            </a>
                        </li>
                    @endcan --}}
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
@endcan
