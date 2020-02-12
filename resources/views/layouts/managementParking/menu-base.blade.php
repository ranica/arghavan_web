@can('menu_base_parking')
    <!-- Base Info Menu -->
    <li>
        <a data-toggle="collapse" href="#baseParkingInfoMenu">
            <i class="material-icons">image</i>
            <p>
            اطلاعات پایه
                <b class="caret"></b>
            </p>
        </a>

        <div class="collapse" id="baseParkingInfoMenu">
            <ul class="nav">
                {{-- Car Color --}}
                @can('car_color')
                    <li>
                        <a href="{{ url('/carColors') }}">
                            <span class="sidebar-normal">
                                رنگ خودرو
                            </span>
                        </a>
                    </li>
                @endcan
                {{-- /Car Color --}}

                {{-- Car Fuel --}}
                @can('car_fuel')
                    <li>
                        <a href="{{ url('/carFuels') }}">
                            <span class="sidebar-normal">
                                سوخت خودرو
                            </span>
                        </a>
                    </li>
                @endcan
                {{-- /Car Fuel --}}

                {{-- Car System --}}
                @can('car_system')
                    <li>
                        <a href="{{ url('/carSystems') }}">
                            <span class="sidebar-normal">
                                سیستم خودرو
                            </span>
                        </a>
                    </li>
                @endcan
                {{-- /Car System --}}

                {{-- Car Model --}}
                @can('car_model')
                    <li>
                        <a href="{{ url('/carModels') }}">
                            <span class="sidebar-normal">
                                مدل خودرو
                            </span>
                        </a>
                    </li>
                @endcan
                {{-- /Car Model --}}

                {{-- Car Level --}}
                @can('car_level')
                    <li>
                        <a href="{{ url('/carLevels') }}">
                            <span class="sidebar-normal">
                                تیپ خودرو
                            </span>
                        </a>
                    </li>
                @endcan
                {{-- /Car Level --}}

                {{-- Car Type --}}
                @can('car_type')
                    <li>
                        <a href="{{ url('/carTypes') }}">
                            <span class="sidebar-normal">
                            نوع خودرو
                            </span>
                        </a>
                    </li>
                @endcan
                {{-- /Car Type --}}

                {{-- Car Plate Type --}}
                @can('car_plate_type')
                    <li>
                        <a href="{{ url('/carPlateTypes') }}">
                            <span class="sidebar-normal">
                            نوع پلاک خودرو
                            </span>
                        </a>
                    </li>
                @endcan
                {{-- /Car Plate Type --}}
            </ul>
        </div>
    </li>
    <!-- Base Info Menu -->
@endcan
